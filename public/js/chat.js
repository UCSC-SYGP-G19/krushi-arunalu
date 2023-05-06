const getDateTimeWithTimezone = (dtString) => {
  let dt = new Date(dtString);
  dt.setMinutes(dt.getMinutes() - dt.getTimezoneOffset());

  let year = dt.getFullYear();
  let month = dt.getMonth() + 1;
  let day = dt.getDate();
  let hour = dt.getHours();
  let minute = dt.getMinutes();
  let second = dt.getSeconds();

  if (month < 10) {
    month = `0${month}`;
  }

  if (day < 10) {
    day = '0' + day;
  }

  if (hour < 10) {
    hour = `0${hour}`;
  }

  if (minute < 10) {
    minute = `0${minute}`;
  }

  if (second < 10) {
    second = `0${second}`;
  }

  return `${year}-${month}-${day} ${hour}:${minute}:${second}`;

  // return dt.toISOString().slice(0, 19).replace('T', ' ');
  // dt.toLocaleString([], { hour:"2-digit", minute: "2-digit", second: "2-digit" });
}

// Realtime chat functionality
let conn = null;

const handleOnOpenConnection = (e) => {
  console.log("Websocket connection established!");

  sendWebSocketMessage({
    "type": "INIT",
    // "timestamp": getDateTimeWithTimezone(new Date()),
    "sender_hash": userTempHash,
  });

  sendWebSocketMessage({
    "type": "STATUS",
    "sender_hash": userTempHash,
    "receiver_id": connectedUsers,
    "message": "Came Online"
  });
}

const handleOnReceiveMessage = (e) => {
  {
    data = JSON.parse(e.data);
    console.log("Message received!");
    console.log(data);

    if (data.type === 'WARNING') {
      Swal.fire({
        title: "Warning",
        text: data.message,
        icon: "warning",
        confirmButtonText: 'OK'
      });
      return;
    }

    if (data.type === 'STATUS') {
      if (data.message === 'Typing') {
        if (selectedReceiverId === data.sender_id) {

          if (!isSelectedReceiverTyping) {
            isSelectedReceiverTyping = true;
            chat.innerHTML += generateTypingBubble();
            chat.scrollBy(0, chat.scrollHeight);

            setTimeout(() => {
              if (isSelectedReceiverTyping) {
                isSelectedReceiverTyping = false;
                chat.querySelector(".typing-bubble").remove();
              }
            }, 3000);
          }
          //
          // setTimeout(() => {
          //   if (isSelectedReceiverTyping) {
          //     chat.innerHTML += generateTypingBubble();
          //     chat.scrollBy(0, chat.scrollHeight);
          //   }
          // }, 2000);
        }
      }

      if (data.message === 'Came Online') {
        if (selectedReceiverId === data.sender_id) {
          // Mark user as online in chat header
          const chatHeader = document.querySelector(".chat-header");
          chatHeader.querySelector(".online-dot").style.visibility = "visible";
          chatHeader.querySelector(".active-status").innerHTML = "Online";
        }

        // Update online status of user in chat cards
        let chatCard = document.querySelector(`#chat-card-${data.sender_id}`);
        if (chatCard) {
          chatCard.querySelector(".online-dot").style.visibility = "visible";
        }
      }

      if (data.message === 'Went Offline') {
        if (selectedReceiverId === data.sender_id) {
          // Mark user as offline in chat header
          const chatHeader = document.querySelector(".chat-header");
          chatHeader.querySelector(".online-dot").style.visibility = "hidden";
          chatHeader.querySelector(".active-status").innerHTML = `Last active: ${getDateTimeWithTimezone(Date.now())}`;
        }

        // Update online status of user in chat cards
        let chatCard = document.querySelector(`#chat-card-${data.sender_id}`);
        if (chatCard) {
          chatCard.querySelector(".online-dot").style.visibility = "hidden";
        }
      }

      if (data.message === 'Online Users') {

        // Update online status of users in chat cards
        data.users.forEach(user => {
          let chatCard = document.querySelector(`#chat-card-${user}`);
          if (chatCard) {
            chatCard.querySelector(".online-dot").style.visibility = "visible";
          }
        });
      }
      return;
    }

    // Render bubble if chat is active
    if (selectedReceiverId === data.sender_id || selectedReceiverId === data.receiver_id) {
      if (isSelectedReceiverTyping) {
        isSelectedReceiverTyping = false;
        chat.querySelector(".typing-bubble").remove();
      }
      chat.innerHTML += generateChatBubble(data, selectedReceiverId);
      chat.scrollBy(0, chat.scrollHeight);
    }

    // Update last received message in chat card
    let chatCard = document.querySelector(`#chat-card-${data.sender_id}`);
    if (chatCard) {
      const chatCardParent = chatCard.parentElement;
      chatCardParent.removeChild(chatCard);

      chatCard.querySelector(".last-message .text-left").innerHTML = data.message;
      chatCard.querySelector(".last-message .text-right").innerHTML = data.sentDateTime.split(' ')[1].substring(0, 5);
      chatCardParent.prepend(chatCard);
    }

    // Update last sent message in chat card
    chatCard = document.querySelector(`#chat-card-${data.receiver_id}`);
    if (chatCard) {
      const chatCardParent = chatCard.parentElement;
      chatCardParent.removeChild(chatCard);

      chatCard.querySelector(".last-message .text-left").innerHTML = "You: " + data.message;
      chatCard.querySelector(".last-message .text-right").innerHTML = data.sentDateTime.split(' ')[1].substring(0, 5);
      chatCardParent.prepend(chatCard);
    }
  }
}

const handleOnCloseConnection = (e) => {
  console.log("Websocket connection closed!");
}

const initWebSocket = () => {
  try {
    conn = new WebSocket(`ws://${window.location.host}:8080`);

    conn.onopen = (e) => handleOnOpenConnection(e);

    conn.onmessage = (e) => handleOnReceiveMessage(e);

    conn.onclose = (e) => handleOnCloseConnection(e);

  } catch (e) {
    alert("Error establishing connection!");
    console.log(e);
  }
}

const sendWebSocketMessage = (data) => {
  try {
    if (conn === null) {
      initWebSocket();
      setTimeout(() => {
        if (conn.readyState === 1) {
          conn.send(JSON.stringify(data));
          console.log("Message sent!");
        } else {
          alert("Error sending message, connection not established!");
        }
      }, 2000);
    } else {
      if (conn.readyState === 1) {
        conn.send(JSON.stringify(data));
        console.log("Message sent!");
      } else {
        alert("Error sending message, connection not established!");
      }
    }

  } catch (e) {
    alert("Error sending message! Try refreshing the page.");
    console.log(e);
  }
}

const fetchOnlineStatusOfUsers = async (connectedUsers) => {
  sendWebSocketMessage({
    "type": "ONLINE_STATUS",
    "sender_hash": userTempHash,
    "message": connectedUsers
  })
}


//Chat Header
const fetchChatHeader = async (chatId) => {
  const res = await fetch(`${URL_ROOT}/chat/getChatDetailsAsJson/` + chatId);
  if (res.status === 200) {
    chatDetails = await res.json();
    let isOnline = false;
    let chatCard = document.querySelector(`#chat-card-${selectedReceiverId}`);
    if (chatCard) {
      isOnline = chatCard.querySelector(".online-dot").style.visibility === "visible";
    }
    renderChatHeader(chatDetails, isOnline);
  }
}

const renderChatHeader = (data, isOnline) => {
  chatHeader.classList.add('chat-header-active');
  if (data == null) {
    chatHeader.innerHTML = renderMessageCard("Error fetching data");
    return;
  }
  console.log(data);
  let chatCard = document.querySelector(`#chat-card-${selectedReceiverId}`);
  if (chatCard) {
    let header = `
            <div class="chat-avatar col-2 col-1-lg m-auto text-center">
                <img alt="User Avatar m-auto" class="avatar" src="${URL_ROOT}/public/img/user-avatars/${data.image_url}" 
                 height="90%">
            <div class="online-dot"></div>
            </div>
            <div class="col-10 col-11-lg m-auto">
                <div class="fw-bold fs-4">${data.name}</div>               
        `;
    if (data.last_login !== null && data.last_login !== "") {
      header += `<div class="active-status text-grey-dark fw-normal">Last active: ${generateDate(data.last_login)}</div>
            </div>`;
    } else {
      header += `</div>`;
    }
    chatHeader.innerHTML = header;
    if (isOnline) {
      chatHeader.querySelector(".online-dot").style.visibility = "visible";
      chatHeader.querySelector(".active-status").innerText = "Online";
    }
  }
}

//Messages

const fetchMessages = async (receiverId) => {
  chat.classList.add('chat-active');
  const res = await fetch(`${URL_ROOT}/chat/getMessagesAsJson/` + receiverId);
  if (res.status === 200) {
    messages = await res.json();
    renderMessages(messages, receiverId);
  }

}

const generateTypingBubble = () => {
  return `
            <div class="chat-msg-received typing-bubble">
                <div class="pt-1 px-2 my-1">
                    <div class="msg-content pt-1 px-1">  
                        <svg opacity="0.3" width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><style>.spinner_qM83{animation:spinner_8HQG 1.05s infinite}.spinner_oXPr{animation-delay:.1s}.spinner_ZTLf{animation-delay:.2s}@keyframes spinner_8HQG{0%,57.14%{animation-timing-function:cubic-bezier(0.33,.66,.66,1);transform:translate(0)}28.57%{animation-timing-function:cubic-bezier(0.33,0,.66,.33);transform:translateY(-6px)}100%{transform:translate(0)}}</style><circle class="spinner_qM83" cx="4" cy="12" r="3"/><circle class="spinner_qM83 spinner_oXPr" cx="12" cy="12" r="3"/><circle class="spinner_qM83 spinner_ZTLf" cx="20" cy="12" r="3"/></svg>
                    </div>
                </div>
            </div>
            `;
}

const generateChatBubble = (element, receiverId) => {
  // element.sent_time = element.sent_time.substring(0, 5);
  let msgBubble = "";
  if (element.receiver_id === receiverId) {
    msgBubble = `
            <div class="chat-msg-sent">
                <div class="py-1 px-2 my-1">
                    <div class="msg-content">${element.message}</div>
                    <div class="sent-time text-grey-dark text-right">${element.sent_date_time.split(' ')[1]}</div>
                </div>
            </div>
            `;
  } else {
    msgBubble = `
            <div class="chat-msg-received">
                <div class="py-1 px-2 my-1">
                                <div class="msg-content">${element.message}</div>
                    <div class="sent-time text-grey-dark text-right">${element.sent_date_time.split(' ')[1]}</div>
                </div>
            </div>
            `;
  }

  return msgBubble;
}

const renderMessages = (data, receiverId) => {
  if (data == null) {
    chat.innerHTML = renderMessageCard("Error fetching data");
    return;
  }
  if (data.length === 0) {
    chat.innerHTML = renderMessageCard("No messages yet");
    return;
  }

  let output = "";

  data.forEach((element) => {
    console.log(element.sent_date_time);
    console.log("Modified");
    element.sent_date_time = getDateTimeWithTimezone(element.sent_date_time);
    console.log(element);

    // modifiedElement.sent_date_time = getDateTimeWithTimezone(new Date(element.sent_date_time));
    // console.log(modifiedElement);
    output += generateChatBubble(element, receiverId);
  });
  chat.innerHTML = output;
  chat.scrollTo(0, chat.scrollHeight);
}

//Message Box
const renderMessageBox = () => {
  messageBox.classList.add('message-input-box-active');
  messageBox.innerHTML = `
        <input placeholder="Type a message" id="message-box" value="">
        <div class="btn-wrapper pl-2">
            <button class="btn-send fw-bold py-1 px-2" disabled>Send</button>
        </div>
    `;
}

//Send messages

const sendMessage = async () => {
  const messageBoxInput = messageBox.querySelector("input");
  const messageText = messageBoxInput.value

  if (messageText === "") {
    return;
  }

  sendWebSocketMessage({
    "type": "MESSAGE",
    // "sentDateTime": getDateTimeWithTimezone(new Date()),
    "sender_hash": userTempHash,
    "receiver_id": selectedReceiverId,
    "message": messageText
  });

  messageBoxInput.value = "";

  // Add to database
  let formData = new FormData;
  formData.append("message", messageText);
  const res = await fetch(`${URL_ROOT}/chat/saveMessage/` + selectedReceiverId, {
    method: "POST",
    body: formData
  });
  if (res.status === 200) {
    console.log("Saved to DB");
    // messageBoxInput.value = "";
  }
}

const viewChat = (id) => {
  selectedReceiverId = id;
  console.log("Viewing chat with " + id);
  document.querySelectorAll('.chat-card').forEach((element) => {
    element.classList.remove('active');
  });
  document.querySelector(`#chat-card-${id}`).classList.add('active');
  chat.innerHTML = "";

  fetchChatHeader(id).then(r => {
    chat.innerHTML = `
            <div class="justify-content-center align-items-center d-flex min-h-100">
                <svg width="48" height="48" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <style>.spinner_7mtw{transform-origin:center;animation:spinner_jgYN .6s linear infinite}@keyframes spinner_jgYN{100%{transform:rotate(360deg)}}</style>
                    <path class="spinner_7mtw" d="M2,12A11.2,11.2,0,0,1,13,1.05C12.67,1,12.34,1,12,1a11,11,0,0,0,0,22c.34,0,.67,0,1-.05C6,23,2,17.74,2,12Z"/>
                </svg>
            </div>
            `;

    renderMessageBox();
    fetchMessages(id);

    const btnSend = document.querySelector(".btn-send");
    btnSend.addEventListener("click", () => {
      sendMessage();
    });

    const messageBoxInput = document.querySelector("#message-box input");
    messageBoxInput.focus();
    messageBoxInput.addEventListener("keyup", (e) => {
      btnSend.disabled = !(messageBoxInput.value.length > 0);

      if (e.key === "Enter") {
        sendMessage();
        btnSend.disabled = true;
        return;
      }

      sendWebSocketMessage({
        "type": "STATUS",
        "sender_hash": userTempHash,
        "receiver_id": selectedReceiverId,
        "message": "Typing"
      });
    });
  });
}

//Chat List

const generateDate = (dateTimeString) => {

  if (dateTimeString === null) {
    return "";
  }

  const dateTime = new Date(dateTimeString);
  const currentDate = new Date().toLocaleDateString();

  if (dateTime.toLocaleDateString() === currentDate) {
    // return dateTime.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});
    return dateTimeString.substring(11, 16);
  } else {
    // return dateTime.toLocaleDateString([], {day: '2-digit', month: '2-digit', year: 'numeric'});
    return dateTimeString.substring(0, 10);
  }

}

const searchChat = () => {
  const searchInputField = document.querySelector("#search-input-field");
  const searchString = searchInputField.value.toLowerCase();
  const allChatNodes = chatListColumn.querySelectorAll(".chat-card");

  let resultCount = 0;

  allChatNodes.forEach((chatNode) => {
    const chatUserName = chatNode.querySelector(".user-name").innerText;
    if (chatUserName.toLowerCase().indexOf(searchString) > -1) {
      chatNode.classList.remove("d-none");
      resultCount++;
    } else {
      chatNode.classList.add("d-none");
    }
  });

}

const renderSearchBar = () => {
  searchBar.innerHTML = `
        <input class="search-input-field" placeholder="Search chats" id="search-input-field" onkeyup="searchChat()">
    `;
}

const fetchChatList = async () => {
  renderSearchBar();
  const res = await fetch(`${URL_ROOT}/chat/getChatListAsJson`);
  if (res.status === 200) {
    chatList = await res.json();
    renderChatList(chatList);
  }
}

const renderChatList = (data) => {
  if (data == null) {
    chatListColumn.innerHTML = renderMessageCard("Error fetching data");
  }
  if (data.length === 0) {
    chatListColumn.innerHTML = renderMessageCard("No connected users");
  }

  let output = "";
  data.forEach((element) => {
    connectedUsers.push(element.id);
    let sender = "";

    if (element.sender_id !== element.id) {
      sender = "You: "
    }

    if (element.last_message === null) {
      element.last_message = "No messages yet";
      sender = "";
    }

    let chatBox = `
            <div class="chat-card px-2 py-2 d-flex" onclick="viewChat(${element.id})" id="chat-card-${element.id}">
                <div class="chat-avatar col-2 m-auto">
                    <img alt="User Avatar" class="avatar"
                    src="${URL_ROOT}/public/img/user-avatars/${element.image_url}"
                    width="85%">
                                     <div class="online-dot"></div>
                </div>
                <div class="col-10 pl-1">
                    <div class="fw-bold user-name">${element.name}</div>
                    <div class="last-message pr-1 text-grey-dark fs-2">
                        <div class="text-left">${sender}${element.last_message}</div>
                        <div class="text-right">${generateDate(getDateTimeWithTimezone(element.sent_date_time))}</div>
                    </div>
                </div>
            </div>
        `;
    output += chatBox;
  });
  chatListColumn.innerHTML = output;
}

//////////////////////////////////////////////////////////////////

let chatList = null;
let chatDetails = null
let messages = null;
let selectedReceiverId = null;
let isSelectedReceiverTyping = false;
let connectedUsers = [];

const chatListColumn = document.querySelector("#chat-list");
const chatHeader = document.querySelector("#chat-header");
const chat = document.querySelector("#chat");
const searchBar = document.querySelector("#search-bar");
const messageBox = document.querySelector("#message-box");

document.addEventListener('DOMContentLoaded', () => {
  if (chatList == null) {
    fetchChatList().then(r => {
      initWebSocket();
      setTimeout(() => {
        fetchOnlineStatusOfUsers(connectedUsers);
      }, 500);
    })
  } else {
    renderChatList();
  }
});
