<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width"/>
	<style>
  <?php include(plugin_dir_path(__FILE__).'common/ink.css'); ?>
  </style>
  <style>
  <?php include(plugin_dir_path(__FILE__).'common/ink-custom.css'); ?>
  </style>
  <style>
  <?php include(plugin_dir_path(__FILE__).'common/wordpress.css'); ?>
  </style>
  <style>
  /* Overrides */
  a, 
  h1 a,
  h2 a,
  h3 a,
  h4 a,
  h5 a,
  h6 a { color: #0064A0 }

  .header {
    background: #0064A0;
  }
  .masthead {
    background: #005587;
  }
  .header h1 { font-size: 42px; font-weight: normal; color: #ffffff; }
  .header h5 { font-size: 12px; font-weight: normal; color: #ffffff; }

  .title { /*color: #64964B;*/ color: #005587; }

  .subtitle { color: #666666; font-size: 22px; }

  .post p,
  .sidebar p { color: #444444; }

  table.spl td {
    border-color: #003C50;
    background-color: #0064A0;
  }

  </style>
</head>
<body>
	<table class="body">
		<tr>
			<td class="center" align="center" valign="top">
        <center>

          <!-- online link -->
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
                                <a href="<?php echo $link; ?>"><strong><?php echo home_url() ?></strong></a>
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
          <!-- header -->
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
                              <a href="<?php echo home_url() ?>"><img height="80" width="170" style="height:80px; width:170px" src="http://news.spokanelibrary.org/assets/img/SPL-Logo-inverse-hidpi.png"></a>
                            </td>
                            <td class="six sub-columns last" style="text-align:right; vertical-align:middle;">
                              <h1 class="serif text-right condensed">News</h1>
                              <h5 class="serif text-right condensed"><em>from your library</em></h5>
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
          <!-- masthead -->
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
                              <p class="white condensed"><?php bloginfo( 'description' ); ?></p>
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

				  <!-- <br> -->
          <table class="container">
            <tr>
              <td>

                <!-- title -->
                <table class="row">
                  <tr>
                    <td class="wrapper last">
                      <table class="twelve columns">
                        <tr>
                          <td>
                            <h1 class="title serif">
                              <a href="<?php echo $link; ?>"><?php echo $title; ?></a>
                            </h1>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table> 
                    </td>
                  </tr>
                </table>

                <!-- message body -->
                <table class="row">
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
                          <td class="sidebar condensed">
                            <p class="condensed">&nbsp;</p>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <tr>
                          <td class="warning panel">
                            <p class="highlight">
                            <em class="serif"><?php echo $callout; ?></em>
                            </p>
                            <span class="muted small">
                            —<?php echo $attribute; ?>
                            </span>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <tr>
                          <td class="condensed">
                            <p class="condensed">&nbsp;</p>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <tr>
                          <td class="">
                            <h2 class="subtitle"><?php echo $subtitle; ?></h2>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <tr>
                          <td class="sidebar ">
                            <?php echo $sidebar; ?>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>
                  
                    </td>
                  </tr>
                </table>

                <!-- selected posts -->
                <?php if ( !is_null($posts[1]) ) : ?>
                <table class="row callout post">
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
                <table class="row callout post">
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
                <table class="row callout post">
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
                <table class="row callout post">
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
                <table class="row callout post">
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
                <table class="row callout post">
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




              <!-- content start -->
              
                <table class="row">
                  <tr>
                    <td class="wrapper">
          
                      <table class="six columns">
                        <tr>
                          <td>
                            <h2>Hello,<br> Han Fastolfe</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. Lorem ipsum dolor sit amet.</p>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>
          
                      <table class="six columns">
                        <tr>
                          <td class="panel">
                            <p>Phasellus dictum sapien a neque luctus cursus. Pellentesque sem dolor, fringilla et pharetra vitae. <a href="#">Click it! »</a></p>
                          </td>
                          
                          <td class="expander"></td>
                        </tr>
                      </table>
          
                      <table class="six columns">
                        <tr>
                          <td>
                            <br>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</p>

                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. Lorem ipsum dolor sit amet.</p>
                            
                            <table class="button">
                              <tr>
                                <td>
                                  <a href="#">Click Me!</a>
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
                          <td class="panel">
                            <h6>Header Thing</h6>
                            <p>Sub-head or something</p>
                            <table>
                              <tr>
                                <td>
                                  <a href="#">Just a Plain Link &raquo;</a>
                                </td>
                              </tr>
                            </table>
                            <hr>
                            <table>
                              <tr>
                                <td>
                                  <a href="#">Just a Plain Link &raquo;</a>
                                </td>
                              </tr>
                            </table>
                            <hr>
                            <table>
                              <tr>
                                <td>
                                  <a href="#">Just a Plain Link &raquo;</a>
                                </td>
                              </tr>
                            </table>
                            <hr>
                            <table>
                              <tr>
                                <td>
                                  <a href="#">Just a Plain Link &raquo;</a>
                                </td>
                              </tr>
                            </table>
                            <hr>
                            <table>
                              <tr>
                                <td>
                                  <a href="#">Just a Plain Link &raquo;</a>
                                </td>
                              </tr>
                            </table>
                            <hr>
                            <table>
                              <tr>
                                <td>
                                  <a href="#">Just a Plain Link &raquo;</a>
                                </td>
                              </tr>
                            </table>
                            <hr>
                            <table>
                              <tr>
                                <td>
                                  <a href="#">Just a Plain Link &raquo;</a>
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>

                      <br>
                      
                      <table class="six columns">
                        <tr>
                          <td class="panel">
                            <h6 style="margin-bottom:5px;">Connect With Us:</h6>
                            <table class="tiny-button facebook">
                              <tr>
                                <td>
                                  <a href="#">Facebook</a>
                                </td>
                              </tr>
                            </table>

                            <hr>

                            <table class="tiny-button twitter">
                              <tr>
                                <td>
                                  <a href="#">Twitter</a>
                                </td>
                              </tr>
                            </table>

                            <hr>

                            <table class="tiny-button google-plus">
                              <tr>
                                <td>
                                  <a href="#">Google +</a>
                                </td>
                              </tr>
                            </table>
                            <br>
                            <h6 style="margin-bottom:5px;">Contact Info:</h6>
                            <p>Phone: <b>408.341.0600</b></p>
                            <p>Email: <a href="mailto:hseldon@trantor.com">hseldon@trantor.com</a></p>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>
          
                    </td>
                  </tr>
                </table>
                <br>
                <br>
                <!-- Legal + Unsubscribe -->            
                <table class="row">
                  <tr>
                    <td class="wrapper last">
            
                      <table class="twelve columns">
                        <tr>
                          <td align="center">
                            <center>
                              <p style="text-align:center;"><a href="#">Terms</a> | <a href="#">Privacy</a> | <a href="#"><unsubscribe>Unsubscribe</unsubscribe></a></p>
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