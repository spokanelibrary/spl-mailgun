<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width"/>
  
  <?php include(plugin_dir_path(__FILE__).'common/ink.css'); ?>
  <style>
  <?php include(plugin_dir_path(__FILE__).'common/wordpress.css'); ?>
  </style>
</head>
<body>
  <table class="body">
    <tr>
      <td class="center" align="center" valign="top">
        <center>

          <table class="row">
            <tr>
              <td class="center" align="center">
                <center>

                  <table class="container">
                    <tr>
                      <td class="wrapper last">
            
                        <table class="twelve columns">
                          <tr>
                            <td class="small center">
                              <center>
                                <strong>Online:</strong>
                                <a href="#"><strong>beta.spokanelibrary.org/newsletter/</strong></a>
                              </center>
                            </td>
                            <td class="expander"></td>
                          </tr>
                        </table>
            
                      </td>
                    </tr>
                  </table>
          
                </center>
              </td>
            </tr>
          </table> 



         
          <table class="row header">
            <tr>
              <td class="center" align="center">
                <center>

                  <table class="container">
                    <tr>
                      <td class="wrapper last">
            
                        <table class="twelve columns">
                          <tr>
                            <td class="six sub-columns">
                              <a href="http://beta.spokanelibrary.org"><img src="http://beta.spokanelibrary.org/assets/img/SPL-Logo-inverse.png" style="height:80px; width:170px;"></a>
                            </td>
                            <td class="six sub-columns last" style="text-align:right; vertical-align:middle;">
                              <h1 class="serif text-right color-light">News</h1>
                              <span class="serif text-right white"><em>from your library</em></span>
                            </td>
                            <td class="expander"></td>
                          </tr>
                        </table>
            
                      </td>
                    </tr>
                  </table>
          
                </center>
              </td>
            </tr>
          </table> 


          <table class="row masthead">
            <tr>
              <td class="center" align="center">
                <center>

                  <table class="container">
                    <tr>
                      <td class="wrapper last">
            
                        <table class="twelve columns">
                          <tr>
                            <td class="seven sub-columns">
                              <p class="white condensed">Read. Learn. Discover.</p>
                            </td>
                            <td class="five sub-columns last" style="text-align:right; vertical-align:middle;">
                              <p class="white condensed text-right"><?php echo $date; ?></p>
                            </td>
                            <td class="expander"></td>
                          </tr>
                        </table>
            
                      </td>
                    </tr>
                  </table>
          
                </center>
              </td>
            </tr>
          </table> 




          <table class="container">
            <tr>
              <td>
                
                <table class="row">
                  <tr>
                    <td class="wrapper last">
                      <table class="twelve columns">
                        <tr>
                          <td>
                            <h1 class="title"><?php echo $title; ?></h1>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table> 
                    </td>
                  </tr>
                </table>


                <table class="row callout">
                  <tr>
                    <td class="wrapper">
                      <table class="eight columns">
                        <tr>
                          <td>
                            <?php echo $content; ?>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>
                    </td>
                    <td class="wrapper last">
                      <table class="four columns">
                        <tr>
                          <td class="warning panel sidebar">
                            <p class="highlight">
                            <?php echo $callout; ?>
                            </p>
                            <span class="muted small">
                            —<?php echo $attribute; ?>
                            </span>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <tr>
                          <td class="sidebar">
                            <p class="separator">&nbsp;</p>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <tr>
                          <td class="sidebar">
                            <h2 class="subtitle"><?php echo $subtitle; ?></h2>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <tr>
                          <td class="panel sidebar">
                            <?php echo $sidebar; ?>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>
                  
                    </td>
                  </tr>
                </table>
                
                <table class="row">
                  <tr>
                    <td class="wrapper last">

                      <table class="twelve columns">
                        <tr>
                          <td class="panel transparent">
                            <h4>Check it out:</h4>
                            <p>Static library stuff here <a href="#">Click it! »</a></p>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>

                    </td>
                  </tr>
                </table>




                
                <?php if ( !is_null($posts[1]) ) : ?>
                <table class="row callout">
                  <tr>
                    <td class="wrapper">
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[1]); 
                    ?>
                    </td>
                    <td class="wrapper last">
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[2]); 
                    ?>
                    </td>
                  </tr>
                </table>
                <?php endif; ?>

                <?php if ( !is_null($posts[3]) ) : ?>
                <table class="row callout">
                  <tr>
                    <td class="wrapper">
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[3]); 
                    ?>
                    </td>
                    <td class="wrapper last">
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[4]); 
                    ?>
                    </td>
                  </tr>
                </table>
                <?php endif; ?>

                <?php if ( !is_null($posts[5]) ) : ?>
                <table class="row callout">
                  <tr>
                    <td class="wrapper">
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[5]); 
                    ?>
                    </td>
                    <td class="wrapper last">
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[6]); 
                    ?>
                    </td>
                  </tr>
                </table>
                <?php endif; ?>

                <?php if ( !is_null($posts[7]) ) : ?>
                <table class="row callout">
                  <tr>
                    <td class="wrapper">
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[7]); 
                    ?>
                    </td>
                    <td class="wrapper last">
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[8]); 
                    ?>
                    </td>
                  </tr>
                </table>
                <?php endif; ?>

                <?php if ( !is_null($posts[9]) ) : ?>
                <table class="row callout">
                  <tr>
                    <td class="wrapper">
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[9]); 
                    ?>
                    </td>
                    <td class="wrapper last">
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[10]); 
                    ?>
                    </td>
                  </tr>
                </table>
                <?php endif; ?>

                <?php if ( !is_null($posts[11]) ) : ?>
                <table class="row callout">
                  <tr>
                    <td class="wrapper">
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[11]); 
                    ?>
                    </td>
                    <td class="wrapper last">
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[12]); 
                    ?>
                    </td>
                  </tr>
                </table>
                <?php endif; ?>
              
                <table class="row footer">
                  <tr>
                    <td class="wrapper">
                            
                      <table class="six columns">
                        <tr>
                          <td class="left-text-pad">

                            <h5>Connect With Us:</h5>

                            <table class="tiny-button facebook">
                              <tr>
                                <td>
                                  <a href="#">Facebook</a>
                                </td>
                              </tr>
                            </table>

                            <br>

                            <table class="tiny-button twitter">
                              <tr>
                                <td>
                                  <a href="#">Twitter</a>
                                </td>
                              </tr>
                            </table>

                            <br>

                            <table class="tiny-button google-plus">
                              <tr>
                                <td>
                                  <a href="#">Google +</a>
                                </td>
                              </tr>
                            </table>

                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>

                    </td>
                    <td class="wrapper last">

                      <table class="six columns">
                        <tr>
                          <td class="last right-text-pad">
                            <h5>Contact Info:</h5>
                            <p>Phone: 408.341.0600</p>
                            <p>Email: <a href="mailto:hseldon@trantor.com">hseldon@trantor.com</a></p>
                          </td>          
                          <td class="expander"></td>
                        </tr>
                      </table>

                    </td>
                  </tr>
                </table>
              
              
                <table class="row">
                  <tr>
                    <td class="wrapper last">
            
                      <table class="twelve columns">
                        <tr>
                          <td align="center">
                            <center>
                              <p style="text-align:center;"><a href="#">Terms</a> | <a href="#">Privacy</a> | <a href="#">Unsubscribe</a></p>
                            </center>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>
            
                    </td>
                  </tr>
                </table>
              <!-- container end below -->
              </td>
            </tr>
          </table> 

        </center>
      </td>
    </tr>
  </table>
</body>
</html>