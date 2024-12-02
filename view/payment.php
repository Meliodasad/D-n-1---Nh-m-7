<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/mainstyle.css">
</head>
<body>
    <?php include('header.php'); ?>
        <section class="payment">
            <div class="container">
                <div class="payment-top-wrap">
                    <div class="payment-top">
                        <div class="payment-top-payment payment-top-item">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="payment-top-payment payment-top-item">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="payment-content row">
                    <div class="payment-content-left">
                        <!-- Phương thức giao hàng -->
                        <p style="font-weight: bold; font-size: 20px;">Phương thức giao hàng</p>
                        <div class="payment-table">
                            <table>
                                <tr>
                                    <td>
                                        <input type="radio" id="delivery-method-1">
                                    </td>
                                    <td>
                                        <label for="delivery-method-1">Giao hàng chuyển phát nhanh</label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    
                        <!-- Phương thức thanh toán -->
                        <p style="font-weight: bold; font-size: 20px;">Phương thức thanh toán</p>
                        <p>Mọi giao dịch đều được bảo mật và mã hoá. Thông tin thẻ tín dụng sẽ không bao giờ được lưu lại</p>
                        <div class="payment-table">
                            <table>
                                <tr>
                                    <td>
                                        <input name="method-payment" type="radio" id="payment-method-1">
                                    </td>
                                    <td>
                                        <label for="payment-method-1">Thanh toán qua thẻ tín dụng (OnePay)</label>
                                    </td>
                                    <td>
                                        <img src="image/visa.png" alt="Visa" width="150" height="80">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input name="method-payment" type="radio" id="payment-method-2">
                                    </td>
                                    <td>
                                        <label for="payment-method-2">Thanh toán qua thẻ ATM (OnePay)</label>
                                    </td>
                                    <td>
                                        <img src="image/bank.png" alt="ATM" width="150" height="80">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input name="method-payment" type="radio" id="payment-method-3">
                                    </td>
                                    <td>
                                        <label for="payment-method-3">Thanh toán qua Momo (OnePay)</label>
                                    </td>
                                    <td>
                                        <img src="image/momo.png" alt="Momo" width="50" height="50">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input name="method-payment" type="radio" id="payment-method-4">
                                    </td>
                                    <td colspan="2">
                                        <label for="payment-method-4">Thanh toán khi nhận hàng</label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    

                    <div class="payment-content-right">
                        <div class="payment-content-right-button">
                            <input type="text" placeholder="Mã giảm giá">
                            <button><i class="fas fa-check"></i></button>
                        </div>
                        <div class="payment-content-right-button">
                            <input type="text" placeholder="Mã giảm giá">
                            <button><i class="fas fa-check"></i></button>
                        </div>
                        <div class="payment-content-right-button-mnv">
                            <select name="" id="">
                                <option value="">Chọn mã ưu đãi</option>
                                <option value="">Ph54666</option>
                                <option value="">Ph54666</option>
                                <option value="">Ph54666</option>
                                <option value="">Ph54666</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="payment-content-right-payment">
                    <button>THANH TOÁN</button>

                </div>
            </div>
        </section>

        <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>
    <script src="js/slide.js"></script>

</body>
</html>