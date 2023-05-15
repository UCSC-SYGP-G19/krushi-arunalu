<?php

include APP_ROOT . "/views/inc/components/Header.php";

?>
    <body class="overflow-hidden full-height">
    <div class="content-with-sidebar">
        <?php
        include APP_ROOT . "/views/inc/components/Sidebar.php"
        ?>
        <main class="content overflow-y-auto">
            <?php
            include APP_ROOT . "/views/inc/components/LoggedInNavbar.php"
            ?>

            <div class="content-wrapper">
                <div class="content p-4 mt-1">
                    <div class="container-fluid px-2">
                        <div class="row pb-2">
                            <?php echo '<a class="btn-md btn-outlined-secondary text-center text-black" href = "
                                 ' . URL_ROOT . '/customer-orders">Back to all orders</a>' ?>
                        </div>
                        <div class="row px-1 pt-1 justify-content-space-between pb-3">
                            <div class="col-6">
                                <h1 class="title">Order details</h1>
                            </div>
                            <div class="col">
                                <a href=""
                                   class="btn-md btn-outlined-primary-light text-center text-primary-light">
                                    ✓ Accepted</a>
                            </div>
                        </div>
                        <div class="order-details-wrapper col-12 d-block">
                            <div class="order-details-container col-12 d-block px-4 py-3 mb-1">
                                <div class="fw-bold col-12">Order ID: <?php
                                    echo $this->data["order-details"]->order_id;
                                    ?></div>
                                <div class="col-12 text-secondary">
                                    Placed on
                                    <?php
                                    echo $this->data["order-details"]->order_date_time;
                                    ?>
                                    by <?php echo $this->data["order-details"]->order_recipient_name; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-justify">
                                    <table>
                                        <thead>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($this->data["order-items"] as $orderItem) {
                                        ?>
                                        <tr class="row">
                                </div>
                                <td class="col-2"><?php
                                    echo '     ' . '<img alt="Product image" height="18%"
                                                         width="35%" 
                                                             src="' . URL_ROOT .
                                        '/public/img/products/' . $orderItem->product_img_url .
                                        '">';
                                    ?></td>
                                <td class="col-4 pr-7"><h4><?php echo $orderItem->product_name; ?></h4>
                                    <?php echo $orderItem->product_description; ?>
                                </td>
                                <td class="col-1"><?php echo $orderItem->quantity; ?></td>
                                <td class="col-1"><?php echo $orderItem->unit_selling_price; ?></td>
                                <td class="col-2"><?php echo $orderItem->quantity *
                                        $orderItem->
                                        unit_selling_price; ?></td>
                                <td class="col-2">
                                    <?php
                                    if ($orderItem->rating == null) {
                                        echo '<a class="btn-outlined-tertiary text-tertiary btn-sm" onclick="showSweetAlert()"> Rate</a>';
                                    } else {
                                        echo '<h6 class="fs-3 fw-normal">
                                                       <svg class="mt-1 mr-1" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.7383 0.881836L13.8283 7.14184L20.7383 8.15184L15.7383 13.0218L16.9183 19.9018L10.7383 16.6518L4.55828 19.9018L5.73828 13.0218L0.738281 8.15184L7.64828 7.14184L10.7383 0.881836Z" fill="#E7A811" stroke="#B89130" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                                                    
                                                        ' . ($orderItem->rating ?? 0.0) . '</h6>';
                                    }
                                    ?>
                                </td>
                                </tr>
                                <?php
                                };
                                ?>
                                </tbody>
                                <!--                                <tfoot>-->
                                <!--                                <tr class="row justify-content-end pagination">-->
                                <!--                                    <td class="col-3 text-right"><span>Rows per page:</span><label>-->
                                <!--                                            <select name="table_filter" id="table_filter">-->
                                <!--                                                <option value="">10</option>-->
                                <!--                                            </select>-->
                                <!--                                        </label></td>-->
                                <!--                                    <td class="col-2">1-2 of 25-->
                                <!--                                        <span class="arrow-icons">-->
                                <!--                                                <span class="left-arrow">-->
                                <!--                                                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none"-->
                                <!--                                                         xmlns="http://www.w3.org/2000/svg">-->
                                <!--                                                    <path d="M7.10107 13.4121L1.10107 7.41211L7.10107 1.41211"-->
                                <!--                                                          stroke="#B1B1B1" stroke-width="2" stroke-linecap="round"-->
                                <!--                                                          stroke-linejoin="round"/>-->
                                <!--                                                </svg>-->
                                <!--                                                </span>-->
                                <!---->
                                <!--                                                <span class="right-arrow">-->
                                <!--                                                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none"-->
                                <!--                                                         xmlns="http://www.w3.org/2000/svg">-->
                                <!--                                                    <path d="M1.854 13.3516L7.854 7.35156L1.854 1.35156"-->
                                <!--                                                          stroke="#B1B1B1" stroke-width="2" stroke-linecap="round"-->
                                <!--                                                          stroke-linejoin="round"/>-->
                                <!--                                                </svg>-->
                                <!--                                                </span>-->
                                <!--                                            </span>-->
                                <!--                                    </td>-->
                                <!--                                </tfoot>-->

                                </table>
                            </div>
                        </div>

                        <div class="d-flex col-12 mt-1">
                            <div class="col-6 pr-1">
                                <div class="delivery-address col-12 py-2">
                                    <h3 class="text-center pb-2">Delivery Address</h3>
                                    <hr/>
                                    <div class="col-12 pt-1 px-4">
                                        <div class="py-1 col-12 d-flex">
                                            <div class="col-5">Recipient name:</div>
                                            <div class="col-7">Vinuri Gamage</div>
                                        </div>
                                        <div class="py-1 col-12 d-flex">
                                            <div class="col-5">Address:</div>
                                            <div class="col-7">  <?php
                                                foreach ($this->data as $orderItem) {
                                                    echo $orderItem->delivery_address;
                                                    break;
                                                }
                                                ?></div>
                                        </div>
                                        <div class="py-1 col-12 d-flex">
                                            <div class="col-5">contact no:</div>
                                            <div class="col-7"><?php
                                                foreach ($this->data as $orderItem) {
                                                    echo $orderItem->contact_no;
                                                    break;
                                                }
                                                ?></div>
                                        </div>
                                        <div class="py-1 col-12 d-flex">
                                            <div class="col-5">Special instructions:</div>
                                            <div class="col-7"><?php
                                                foreach ($this->data as $orderItem) {
                                                    echo $orderItem->delivery_instructions;
                                                    break;
                                                }
                                                ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="order-summary col-6 py-2">
                                <h3 class="text-center pb-2">Order Summary</h3>
                                <hr/>
                                <div class="col-12 pt-1 px-4">
                                    <div class="py-1 col-12 d-flex">
                                        <div class="col-5">No of items:</div>
                                        <div class="col-7"><?php echo count($this->data["order-items"]) ?></div>
                                    </div>
                                    <div class="py-1 col-12 d-flex">
                                        <div class="col-5">Sub-total:</div>
                                        <div class="col-7"><?php echo $this->data["order-details"]->order_total ?>.00
                                        </div>
                                    </div>
                                    <div class="py-1 col-12 d-flex">
                                        <div class="col-5">Discounts:</div>
                                        <div class="col-7">Rs. 0.00</div>
                                    </div>
                                    <div class="py-1 col-12 d-flex">
                                        <div class="col-5">Order total:</div>
                                        <div class="col-7"><?php echo $this->data["order-details"]->order_total ?>.00
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php
    include APP_ROOT . "/views/inc/components/Footer.php";
    ?>
    </>

    <script>
      let selectedRating = null;

      function rate(value) {
        selectedRating = value;
        document.querySelectorAll(".rating span svg").forEach((svg) => {
          svg.classList.remove("filled");
        })


        for (let i = 1; i <= value; i++) {
          document.querySelector(`#star-${i} svg`).classList.add("filled");

        }
      }

      async function showSweetAlert(orderId, productId) {
        Swal.fire({
          title: "Add Rating",
          html: `
      <section class="col-12 text-center px-4 py-0">
        <div class="row rating justify-content-center align-items-center mt-3 mb-2">
<!--              <div class=col-1></div>-->
<!--              <div class=col-2><input type="checkbox" id="star1" name="rate" value="1" />-->
<!--              <label for="star1" title="text">1 star</label></div>-->
<!--              <div class=col-2><input type="checkbox" id="star2" name="rate" value="2" />-->
<!--              <label for="star2" title="text">2 stars</label></div>-->
<!--              <div class=col-2><input type="checkbox" id="star3" name="rate" value="3" />-->
<!--              <label for="star3" title="text">3 stars</label></div>-->
<!--              <div class=col-2><input type="checkbox" id="star4" name="rate" value="4" />-->
<!--              <label for="star4" title="text">4 stars</label></div>-->
<!--              <div class=col-2><input type="checkbox" id="star5" name="rate" value="5" />-->
<!--              <label for="star5" title="text">5 stars</label></div>-->
<!--              <div class=col-1></div>-->
                <span class="mx-1 clickable" id="star-1" onclick="rate(1)">
                <svg width="47" height="44" viewBox="0 0 47 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.2353 35.5882L8.41176 43L12.1176 28.1765L1 15.8235L17.0588 14.5882L23.2353 1L29.4118 14.5882L45.4706 15.8235L34.3529 28.1765L38.0588 43L23.2353 35.5882Z" stroke="#B89130" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                </span>
                <span class="mx-1 clickable" id="star-2"  onclick="rate(2)">
                <svg width="47" height="44" viewBox="0 0 47 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.2353 35.5882L8.41176 43L12.1176 28.1765L1 15.8235L17.0588 14.5882L23.2353 1L29.4118 14.5882L45.4706 15.8235L34.3529 28.1765L38.0588 43L23.2353 35.5882Z" stroke="#B89130" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                </span>

                <span class="mx-1 clickable"  id="star-3" onclick="rate(3)">
                <svg width="47" height="44" viewBox="0 0 47 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.2353 35.5882L8.41176 43L12.1176 28.1765L1 15.8235L17.0588 14.5882L23.2353 1L29.4118 14.5882L45.4706 15.8235L34.3529 28.1765L38.0588 43L23.2353 35.5882Z" stroke="#B89130" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                </span>


                <span class="mx-1 clickable"  id="star-4" onclick="rate(4)">
                <svg width="47" height="44" viewBox="0 0 47 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.2353 35.5882L8.41176 43L12.1176 28.1765L1 15.8235L17.0588 14.5882L23.2353 1L29.4118 14.5882L45.4706 15.8235L34.3529 28.1765L38.0588 43L23.2353 35.5882Z" stroke="#B89130" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                </span>

                <span class="mx-1 clickable"  id="star-5" onclick="rate(5)">
                <svg width="47" height="44" viewBox="0 0 47 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.2353 35.5882L8.41176 43L12.1176 28.1765L1 15.8235L17.0588 14.5882L23.2353 1L29.4118 14.5882L45.4706 15.8235L34.3529 28.1765L38.0588 43L23.2353 35.5882Z" stroke="#B89130" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                </span>
        </div>
      </section>
    `,
          showCancelButton: true,
          cancelButtonText: 'Cancel',
          confirmButtonText: 'Submit',
          showLoaderOnConfirm: true,
          // // if user clicks on confirm button
          preConfirm: () => {
            // if user has not checked the checkbox
            if (selectedRating === null) {
              Swal.showValidationMessage('Please select a rating');
            }
          }
        }).then(async (result) => {
            // if submit is pressed
            if (result.isConfirmed) {
              let formData = new FormData();
              formData.append("product_id", productId);
              formData.append("order_id", orderId);
              formData.append("rating", selectedRating);
              const res = await fetch(`${URL_ROOT}/customerOrders/rateProduct`, {
                method: "POST",
                body: formData
              });
              Swal.fire({
                icon: "success",
                text: "Rating added successfully"
              });
            }
          }
        );
      }

    </script>
    </body>
<?php
include APP_ROOT . "/views/inc/components/EndingTag.php";

