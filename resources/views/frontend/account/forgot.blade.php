<!DOCTYPE html> 
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mail</title>
</head>
<body>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" bgcolor="#dcf0f8" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
  <tbody>
    <tr>

      <td align="center" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:left;padding-left:20px">
        <h2>Chào quý khách,</h2>
        <p><span style="font-weight:bold">NhaDat</span> đã nhận được yêu cầu thay đổi mật khẩu của quý khách.</p>
        <p>Xin hãy click vào đường dẫn sau để đổi mật khẩu:</p>
        <a href="{{ route('reset-password', $key) }}" style="color:red; font-weight:bold" target="_blank" >{{ route('reset-password', $key) }}</a>
        <p>Mọi thắc mắc và góp ý vui lòng liên hệ với chúng tôi qua email: <span style="color:red; font-weight:bold">support@icho.vn</span> hoặc số điện thoại <span style="color:red; font-weight:bold">1900 636 975</span> (8-21h cả T7,CN).</p>
        <p>Trân trọng,<br> <span style="font-weight:bold">NhaDat</span></p>
        
      </td>
    </tr>    
  </tbody>
</table>

</body>
</html>
