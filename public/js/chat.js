const getDateTimeWithTimezone = () => {
  let dt = new Date();
  dt = new Date(dt.setMinutes(dt.getMinutes() - dt.getTimezoneOffset()));
  return dt.toISOString().slice(0, 19).replace('T', ' ');
}

// Realtime chat functionality
let conn = null;
const initWebSocket = () => {
  try {
    conn = new WebSocket(`ws://${window.location.host}:8080`);

    conn.onopen = (e) => {
      console.log("Websocket connection established!");
      const initData = {
        "type": "INIT",
        "timestamp": getDateTimeWithTimezone(),
        "tempHash": userTempHash,
      }

      conn.send(JSON.stringify(initData));
    };

    conn.onmessage = (e) => {
      data = JSON.parse(e.data);
      console.log("Message received!");
      console.log(data);

      // Render bubble if chat is active
      if (selectedReceiverId === data.sender_id || selectedReceiverId === data.receiver_id) {
        chat.innerHTML += generateChatBubble(data, selectedReceiverId);
        chat.scrollBy(0, chat.scrollHeight);
      }

      // Update last message in chat card
      const chatCard = document.querySelector(`#chat-card-${data.sender_id}`);
      if (chatCard) {
        const chatCardParent = chatCard.parentElement;
        chatCardParent.removeChild(chatCard);
        chatCard.querySelector(".last-message .text-left").innerHTML = data.message;
        chatCard.querySelector(".last-message .text-right").innerHTML = data.sent_date_time.split(' ')[1].substring(0, 5);
        chatCardParent.prepend(chatCard);
      }
    };

  } catch (e) {
    alert("Error establishing connection!");
    console.log(e);
  }
}

const sendWebSocketMessage = (data) => {
  try {
    if (conn === null) {
      initWebSocket();
    }
    if (conn.readyState === 1) {
      conn.send(JSON.stringify(data));
      console.log("Message sent!");
    } else {
      alert("Error sending message, connection not established!");
    }

  } catch (e) {
    alert("Error sending message! Try refreshing the page.");
    console.log(e);
  }
}


//Chat Header
const fetchChatHeader = async (chatId) => {
  const res = await fetch(`${URL_ROOT}/chat/getChatDetailsAsJson/` + chatId);
  if (res.status === 200) {
    chatDetails = await res.json();
    renderChatHeader(chatDetails);
  }
}

const renderChatHeader = (data) => {
  chatHeader.classList.add('chat-header-active');
  if (data == null) {
    chatHeader.innerHTML = renderMessageCard("Error fetching data");
    return;
  }
  console.log(data);
  chatHeader.innerHTML = `
            <div class="chat-avatar col-2 col-1-lg m-auto text-center">
                <img alt="User Avatar m-auto" class="avatar" src="${URL_ROOT}/public/img/user-avatars/${data.image_url}" 
                 height="90%">
            </div>
            <div class="col-10 col-11-lg m-auto">
                <div class="fw-bold fs-4">${data.name}</div>
                <div class="active-status text-grey-dark fw-normal">Last active: ${data.last_login}</div>
            </div>
        `;
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
    output += generateChatBubble(element, receiverId);
  });
  chat.innerHTML = output;
  chat.scrollTo(0, chat.scrollHeight);
}

//Message Box
const renderMessageBox = () => {
  messageBox.classList.add('message-input-box-active');
  messageBox.innerHTML = `
        <input placeholder="Type a message" id="message-box" required onkeydown="">
        <div class="btn-wrapper pl-2">
            <button class="btn-send fw-bold py-1 px-2">Send</button>
        </div>
    `;
}

//Send messages

const sendMessage = async () => {
  const messageBox = document.querySelector(`#message-box`).querySelector("input");
  const messageText = messageBox.value

  sendWebSocketMessage({
    "type": "MESSAGE",
    "sentDateTime": getDateTimeWithTimezone(),
    "tempHash": userTempHash,
    "receiverId": selectedReceiverId,
    "message": messageText
  });

  messageBox.value = "";

  // let formData = new FormData;
  // formData.append("message", messageText);
  // const res = await fetch(`${URL_ROOT}/chat/sendMessage/` + receiverId, {
  //     method: "POST",
  //     body: formData
  // });
  // if (res.status === 200) {
  //     messageBox.value = "";
  // }
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
    document.querySelector(".btn-send").addEventListener("click", () => {
      sendMessage();
    });
    document.querySelector("#message-box").focus();
    document.querySelector("#message-box").addEventListener("keydown", (e) => {
      if (e.key === "Enter") {
        sendMessage();
      }
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
    return dateTime.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});
  } else {
    return dateTime.toLocaleDateString([], {day: '2-digit', month: '2-digit', year: 'numeric'});
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

    let sender = null;

        if (element.sender_id === element.id) {
            sender = element.name + ": ";
        } else {
            sender = "You: "
        }if (element.last_message === null) {
      element.last_message = "No messages yet";sender = "";
        }

    let chatBox = `
            <div class="chat-card px-2 py-2 d-flex" onclick="viewChat(${element.id})" id="chat-card-${element.id}">
                <div class="chat-avatar col-2 m-auto">
                    <img alt="User Avatar" class="avatar"
                    src="${URL_ROOT}/public/img/user-avatars/${element.image_url}"
                    width="85%">
                </div>
                <div class="col-10 pl-1">
                    <div class="fw-bold user-name">${element.name}</div>
                    <div class="last-message pr-1 text-grey-dark fs-2">
                        <div class="text-left">${sender}${element.last_message}</div>
                        <div class="text-right">${generateDate(element.sent_date_time)}</div>
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

const chatListColumn = document.querySelector("#chat-list");
const chatHeader = document.querySelector("#chat-header");
const chat = document.querySelector("#chat");
const searchBar = document.querySelector("#search-bar");
const messageBox = document.querySelector("#message-box");

document.addEventListener('DOMContentLoaded', () => {
  initWebSocket();
  if (chatList == null) {
    fetchChatList();
  } else {
    renderChatList();
  }
});
