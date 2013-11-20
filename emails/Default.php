 
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
        <meta name="viewport" content="width=device-width;initial-scale=1.0; user-scalable=1;" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Progressive Disclosure sample template</title>
<style>
body, p {
  font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -webkit-text-size-adjust:none;
}
a:hover {
  text-decoration: underline !important;
}
td.contentblock h4 {
  color:#444444 !important;
  font-size:16px;
  line-height:24px;
  margin-top:0;
  margin-bottom:10px;
  padding-top:0;
  padding-bottom:0;
  font-weight:normal;
}
td.contentblock h4 a {
  color:#444444;
  text-decoration:none;
}
td.contentblock p {
  color:#888888;
  font-size:13px;
  line-height:19px;
  margin-top:0;
  margin-bottom:12px;
  padding-top:0;
  padding-bottom:0;
  font-weight:normal;
}
td.contentblock p a {
  color:#3ca7dd;
  text-decoration:none;
}
.readmore {
  font-size: 13px;
  color: #85bdad;
}
.ReadMsgBody {
  width: 100%;
}
.ExternalClass {
  width: 100%;
}
img {
  display: block;
}
a.mobileshow, .mobilehide {
  display: none;
  color: #fff; /*for Gmail */
}
 
/* Mobile stylesheet for iPhone and Android */
 
@media only screen and (max-width: 480px) {
 table {
 position: relative;
}
 a[class="mobileshow"], a[class="mobilehide"] {
 display: block !important;
 color: #fff !important;
 background-color: #aaa;
 border-radius: 20px;
 padding: 0 8px;
 text-decoration: none;
 font-weight: bold;
 font-size: 11px;
 position: absolute;
 top: 25px;
 right: 10px;
 text-align: center;
 width: 40px;
}
 div[class="article"] {
 display: none;
}
 a.mobileshow:hover {
 visibility: hidden;
}
 .mobileshow:hover + .article,
 .article:hover {
  /* .article:hover to inherit the state of a tapped link, keeping the box visible - eg */
 display: inline !important;
}
 div[class="header"] {
 font-size: 16px !important;
}
 table[class="table"], td[class="cell"] {
 width: 320px !important;
}
 td[class="footershow"] {
 width: 320px !important;
 padding-left: 25px;
 padding-right: 25px;
}
 table[class="hide"], img[class="hide"], td[class="hide"] {
 display: none !important;
}
 img[class="divider"] {
 height: 1px !important;
}
 p[class="reminder"] {
 font-size: 11px !important;
}
 h4[class="secondary"] {
 line-height: 22px !important;
 margin-bottom: 15px !important;
 font-size: 18px !important;
}
}
 @media screen and (device-width: 480px) and (device-height: 360px), screen and (device-width: 360px) and (device-height: 480px), screen and (device-width: 320px) and (device-height: 240px) {
 .article {
 display: inline !important;
}
 a.mobileshow, a.mobilehide {
 display: none !important;
}
}
</style>
</head>
<body bgcolor="#e4e4e4" style="margin: 0; padding: 0;">
<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#e4e4e4">
  <tr>
    <td bgcolor="#e4e4e4" width="100%"><table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="table">
        <tr>
          <td width="600" class="cell"><br>
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td bgcolor="#ef3101" nowrap><img border="0" src="images/spacer.gif" width="5" height="1"></td>
                <td width="100%" bgcolor="#ffffff"><table width="100%" cellpadding="20" cellspacing="0" border="0">
                    <tr>
                      <td bgcolor="#ffffff" class="contentblock"><h4 class="secondary"><strong><a href="http://en.wikipedia.org/wiki/Kitten" class="link">Kittens</a></strong> </h4>
                        <p>A kitten is a juvenile domesticated cat.</p>
                        <a href="#" class="mobilehide">Hide</a> <a href="#" class="mobileshow">Show</a>
                        <div class="article">
                          <p class="bodytext"><img src="http://placekitten.com/75/75" style="margin: 0 10px 10px 0; float: left;" >A feline litter usually consists of two to five kittens. To survive, kittens need the care of their mother for the first several weeks of their life. Kittens are highly social animals and spend most of their waking hours playing and interacting with available companions.</p>
                        </div>
                        <a href="http://en.wikipedia.org/wiki/Kitten" class="readmore">Read the full article</a></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <img border="0" src="images/spacer.gif" width="1" height="15" class="divider"><br>
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td bgcolor="#ef3101" nowrap><img border="0" src="images/spacer.gif" width="5" height="1"></td>
                <td width="100%" bgcolor="#ffffff"><table width="100%" cellpadding="20" cellspacing="0" border="0">
                    <tr>
                      <td bgcolor="#ffffff" class="contentblock"><h4 class="secondary"> <strong><a href="http://en.wikipedia.org/wiki/Kitten" class="link">Etymology</a></strong> </h4>
                        <p>The word &quot;kitten&quot; derives from Middle English kitoun (ketoun, kyton etc.), which itself came from Old French chitoun, cheton: &quot;kitten&quot;.</p>
                        <a href="#" class="mobilehide">Hide</a> <a href="#" class="mobileshow">Show</a>
                        <div class="article">
                          <p class="bodytext"><img src="http://placekitten.com/75/75" style="margin: 0 10px 10px 0; float: left;"> The young of big cats are called cubs rather than <a href="#">kittens</a>. Either term may be used for the young of smaller wild felids such as ocelots, caracals, and lynx, but &quot;kitten&quot; is usually more common for these species.</p>
                        </div>
                        <a href="http://en.wikipedia.org/wiki/Kitten" class="readmore">Read the full article</a></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <img border="0" src="images/spacer.gif" width="1" height="15" class="divider"><br></td>
        </tr>
      </table>
      <img border="0" src="images/spacer.gif" width="1" height="25" class="divider"><br>
      <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f2f2f2">
        <tr>
          <td><img border="0" src="images/spacer.gif" width="1" height="25" class="divider"><br>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="table">
              <tr>
                <td width="600" nowrap bgcolor="#f2f2f2" class="cell"><table width="600" cellpadding="0" cellspacing="0" border="0" class="table">
                    <tr>
                      <td width="380" valign="top" class="footershow"><img border="0" src="images/spacer.gif" width="1" height="8" class="divider"><br>
                        <p style="color:#a6a6a6;font-size:12px;font-family:Helvetica,Arial,sans-serif;margin-top:0;margin-bottom:15px;padding-top:0;padding-bottom:0;line-height:18px;" class="reminder">You’re receiving this because you’re an awesome ABC Widgets customer or subscribed via <a href="http://www.abcwidgets.com/" style="color:#a6a6a6;text-decoration:underline;">our site</a>.</p>
                        <p style="color:#c9c9c9;font-size:12px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">
                          <preferences style="color:#3ca7dd;text-decoration:none;">Edit your subscription</preferences>
                          &nbsp;&nbsp;|&nbsp;&nbsp;
                          <unsubscribe style="color:#3ca7dd;text-decoration:none;">Unsubscribe instantly</unsubscribe>
                        </p></td>
                      <td align="right" width="220" style="color:#a6a6a6;font-size:12px;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;text-shadow: 0 1px 0 #ffffff;" valign="top" class="hide"><table cellpadding="0" cellspacing="0" border="0">
                          <tr>
                            <td><a href="http://www.flickr.com/photos/freshview"><img border="0" src="images/flickr.gif" width="42" height="32" alt="See our photos on Flickr"></a></td>
                            <td><a href="http://twitter.com/campaignmonitor"><img border="0" src="images/twitter.gif" width="42" height="32" alt="Follow us on Twitter"></a></td>
                            <td><a href="http://www.facebook.com/campaignmonitor"><img border="0" src="images/facebook.gif" width="32" height="32" alt="Visit us on Facebook"></a></td>
                          </tr>
                        </table>
                        <img border="0" src="images/spacer.gif" width="1" height="10"><br>
                        <p style="color:#b3b3b3;font-size:11px;line-height:15px;font-family:Helvetica,Arial,sans-serif;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0;font-weight:bold;">ABC Widgets</p>
                        <p style="color:#b3b3b3;font-size:11px;line-height:15px;font-family:Helvetica,Arial,sans-serif;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0;font-weight:normal;">87 Street Avenue, California, USA</p></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <img border="0" src="images/spacer.gif" width="1" height="25" class="divider"><br></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
