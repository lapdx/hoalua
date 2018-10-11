<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order</title>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#fff" width="650" style="border:1px solid #eee;">
	<tbody>
    	<tr>
        	<td valign="top">
            	<div style="height:90px; background:#fff;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td valign="top" style="text-align:center;">
                                    <a href="http://hoaluaco.vn" style="border:none;"><img src="http://hoaluaco.vn/images/logo.png" alt="logo" style="border:none;" /></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
		<tr>
        	<td valign="top" style="background:#fff;">
            	<table border="0" cellpadding="0" cellspacing="0" align="left" width="100%" bgcolor="#fff">
                    <tbody>
                        <tr>
                        	<td valign="top" width="20%" style="padding:12px 0; color:#343639; border-right:1px solid #da7500; background:#fa8600; text-align:center;">
                                    <a href="<?= route("frontend::home") ?>" style="font-family:Arial, Helvetica, sans-serif; font-size: 14px; font-weight:bold; color:#fff; text-decoration:none;">Trang chủ</a>
                            </td>
							<td valign="top" width="20%" style="padding:12px 0; color:#343639; border-right:1px solid #da7500; background:#fa8600; text-align:center;">
                            	<a href="<?= route("frontend::home") ?>" style="font-family:Arial, Helvetica, sans-serif; font-size: 14px; font-weight:bold; color:#fff; text-decoration:none;">Sản phẩm</a>
                            </td>
							<td valign="top" width="20%" style="padding:12px 0; color:#343639; border-right:1px solid #da7500; background:#fa8600; text-align:center;">
                            	<a href="<?= route("frontend::home") ?>" style="font-family:Arial, Helvetica, sans-serif; font-size: 14px; font-weight:bold; color:#fff; text-decoration:none;">Khuyến mại</a>
                            </td>
							<td valign="top" width="20%" style="padding:12px 0; color:#343639; border-right:1px solid #da7500; background:#fa8600; text-align:center;">
                            	<a href="<?= route("frontend::home") ?>" style="font-family:Arial, Helvetica, sans-serif; font-size: 14px; font-weight:bold; color:#fff; text-decoration:none;">Tin tức</a>
                            </td>
							<td valign="top" width="20%" style="padding:12px 0; color:#343639; background:#fa8600; text-align:center;">
                            	<a href="<?= route("frontend::home") ?>" style="font-family:Arial, Helvetica, sans-serif; font-size: 14px; font-weight:bold; color:#fff; text-decoration:none;">Liên hệ</a>
                            </td>
						</tr>
                    </tbody>
                </table>	
            </td>
        </tr>
        <tr>
        	<td valign="top" style="padding:10px 10px 10px 25px; background:#fff;">
            	<div style="padding-top:5px;">
                	<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;display:block; color:#333;">
                    	Khách hàng <?= $order->name ?>
                    </font>
                </div>
            	<div style="padding-top:5px;">
                	<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;display:block; color:#333;">
                    	Số điện thoại <?= $order->phone ?>
                    </font>
                </div>
            	<div style="padding-top:5px;">
                	<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;display:block; color:#333;">
                    	Địa chỉ <?= $order->delivery_address ?>
                    </font>
                </div>
            	<div style="padding-top:5px;">
                	<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;display:block; color:#333;">
                    	Ghi chú <?= $order->note ?>
                    </font>
                </div>
                <div style="padding-top:10px; font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#333;">
                    <table width="100%" cellspacing="0" cellpadding="0" border="1" style="border-collapse:collapse;text-align:center">
                        <tbody>
                            <tr style="background:#f1f1f1">
                                <th width="60%" height="30px">Tên sản phẩm</th>
                                <th width="15%" height="30px">Đơn giá</th>
                                <th width="10%" height="30px">Số lượng</th>
                                <th width="15%" height="30px">Thành tiền</th>
                            </tr>
                            <?php foreach ($products as $item) { ?>
                            <tr>
                                <td height="30px"><?= $item->product_name ?></td>
                                <td height="30px"><?= number_format($item->unit_price, 0, ".", ",") ?> VNĐ</td>
                                <td height="30px"><?= $item->quantity?></td>
                                <td height="30px"><?= number_format($item->unit_price*$item->quantity, 0, ".", ",") ?> VNĐ</td>
                            </tr>
                           <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div style="padding-top:10px;">
                	<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;display:block; color:#333;">
                    	<b>Tổng tiền:</b> <?= number_format($order->amount, 0, ".", ",") ?> VNĐ
                    </font>
                </div>
				<div style="padding-top:10px;">
               		<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;display:block; color:#074246;">
                    	<b>Tình trạng:</b> Đã đặt hàng</a>
                    </font>
                </div>
                <div style="padding-top:10px;">
               		<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;display:block; color:#333;">
                    	Thân ái!
                    </font>
                </div>
                <div style="padding-top:10px;">
               		<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;display:block; color:#333;">
                    	Trung Tâm Hỗ Trợ Khách Hàng hoaluaco.vn
                    </font>
                </div>
            </td>
        </tr>
        <tr>
        	<td valign="top" style="background:#fff;">
            	<table border="0" cellpadding="0" cellspacing="0" align="left" width="100%" bgcolor="#fff">
                    <tbody>
						<tr>
                            <td valign="top">
                            	<div style="padding-top:10px; padding-right:10px; padding-bottom:10px; padding-left:25px; line-height:20px; font-weight:normal; background:#cb6f00; text-align:center;">
                                	<font style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; color:#fff;">                                  	
										Tư vấn online: <span style="color:#fff;">(84) 977.112.887</span> | Giờ bán hàng: <span style="color:#fff;">8.00 AM - 21:00 PM</span>
                                    </font>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>	
            </td>
        </tr>
    </tbody>
</table>
</body>
</html>