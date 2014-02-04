<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width"/>
	<style>
  <?php include(plugin_dir_path(__FILE__).'common/ink.css'); ?>
  </style>
  <style>
  <?php include(plugin_dir_path(__FILE__).'common/wordpress.css'); ?>
  </style>
  <style>
  <?php include(plugin_dir_path(__FILE__).'common/ink-custom.css'); ?>
  </style>
  <style>
  /* Additional overrides and customs, but be careful here */

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
                          <?php if ($prepend) : ?>
                          <tr>
                            <td class="prepend">
                              <?php echo $prepend; ?>
                            </td>
                            <td class="expander"></td>
                          </tr>
                          <?php endif; ?>
                          <tr>
                            <td class="small center">
                              <center>
                                <strong class="muted">Read&nbsp;Online:</strong>
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

          <!-- wrap extra row to prevent table spacing -->
          <table class="row">
            <tr>
              <td>

                <!-- masthead -->
                <table class="row masthead" cellpadding="0" cellspacing="0" border="0">
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

              </td>
            </tr>
            <tr>
              <td>
                <!-- dateline -->
                <table class="row dateline" cellpadding="0" cellspacing="0" border="0">
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
                            <h1 class="title">
                              <a href="<?php echo $link; ?>"><span class="serif"><?php echo $title; ?></span></a>
                            </h1>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table> 
                    </td>
                  </tr>
                </table>

                <!-- message body -->
                <?php 
                  $primary_columns = 'eight';
                  if ( empty($sidebar) ) {
                    $primary_columns = 'twelve';
                  }
                ?>
                <table class="row">
                  <tr>
                    <td class="wrapper <?php if ( empty($sidebar) ): ?>last<?php endif; ?>" style="padding-top:0;">
                      <table class="<?php echo $primary_columns; ?> columns">
                        <tr>
                          <td>
                            <?php echo $content; ?>
                            <h4 class="center">
                              <center>...</center>
                            </h4>
                          </td>
                          <td class="expander"></td>
                        </tr>

                        <!-- selected posts -->
                        <?php if ( !is_null($posts[1]) ) : ?>
                        <tr>
                          <td>
                          <?php 
                          echo SPL_Mailgun_Newsletter::formatPostSelect($posts[1], '<?php echo $primary_columns; ?> columns'); 
                          ?>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <?php endif; ?>

                        <?php if ( !is_null($posts[2]) ) : ?>
                        <tr>
                          <td>
                          <?php 
                          echo SPL_Mailgun_Newsletter::formatPostSelect($posts[2], '<?php echo $primary_columns; ?> columns'); 
                          ?>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <?php endif; ?>

                        <?php if ( !is_null($posts[3]) ) : ?>
                        <tr>
                          <td>
                          <?php 
                          echo SPL_Mailgun_Newsletter::formatPostSelect($posts[3], 'eight columns'); 
                          ?>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <?php endif; ?>

                        <?php if ( !is_null($posts[4]) ) : ?>
                        <tr>
                          <td>
                          <?php 
                          echo SPL_Mailgun_Newsletter::formatPostSelect($posts[4], 'eight columns'); 
                          ?>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <?php endif; ?>

                      </table>
                    </td>

                    <?php if ( !empty($sidebar) ): ?>
                    <td class="wrapper last">
                      
                      <table class="four columns" style="margin-bottom: 20px;">
                        <tr>
                          <td class="condensed">
                            <p class="condensed">&nbsp;</p>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <?php if ( !empty($callout) ) : ?>
                        <tr>
                          <td class="warning panel">
                            <p class="highlight">
                            <em class=""><?php echo $callout; ?></em>
                            </p>
                            <?php if ( !empty($attribute) ) : ?>
                            <span class="muted small">
                            —<?php echo $attribute; ?>
                            </span>
                            <?php endif; ?>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <tr>
                          <td class="condensed">
                            <p class="condensed">&nbsp;</p>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                          <td class="sidebar subtitle">
                            <h2 class="subtitle"><?php echo $subtitle; ?></h2>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <tr>
                          <td class="sidebar text-pad-left text-pad-right">
                            <?php echo $sidebar; ?>

                            <?php
                            for ( $i=1; $i<= 12; $i++ ) {
                              echo SPL_Mailgun_Newsletter::formatPostSelectSidebar($sb_posts[$i]);
                            }
                            ?>

                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>
                  
                    </td>
                    <?php endif; ?>
                  </tr>
                </table>

                <!-- selected posts -->

                <?php if ( !is_null($posts[5]) ) : ?>
                <table class="row callout">
                  <?php if ( !is_null($posts[5]) ) : ?>
                  <tr>
                    <td>
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[5], 'twelve columns'); 
                    ?>
                    </td>
                    <td class="expander"></td>
                  </tr>
                  <?php endif; ?>
                  <?php if ( !is_null($posts[6]) ) : ?>
                  <tr>
                    <td>
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[6], 'twelve columns'); 
                    ?>
                    </td>
                    <td class="expander"></td>
                  </tr>
                  <?php endif; ?>
                </table>
                <?php endif; ?>
                
                <?php if ( !is_null($posts[7]) ) : ?>
                <table class="row callout">
                  <tr>
                    <td class="wrapper">
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[7], 'six columns'); 
                    ?>
                    </td>
                    <td class="wrapper last">
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[8], 'six columns'); 
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
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[9], 'six columns'); 
                    ?>
                    </td>
                    <td class="wrapper last">
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[10], 'six columns'); 
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
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[11], 'six columns'); 
                    ?>
                    </td>
                    <td class="wrapper last">
                    <?php 
                    echo SPL_Mailgun_Newsletter::formatPostSelect($posts[12], 'six columns'); 
                    ?>
                    </td>
                  </tr>
                </table>
                <?php endif; ?>

                <!-- colophon -->

                <!-- wrap the colophon tables to avoid seperation -->
                <table>
                  <tr>
                    <td>

                      <table class="row footer">
                        <tr>
                          <td class="wrapper last" style="padding-bottom:0;">
                                  
                            <table class="twelve columns">
                              <tr>
                                <td class="left-text-pad">

                                  <h5 style="padding-bottom:0; margin-bottom:0;">Connect with us:</h5>

                                </td>
                                <td class="expander"></td>
                              </tr>
                            </table>

                          </td>
                        </tr>
                      </table>

                    </td>
                  </tr>
                  <tr>
                    <td>

                      <table class="row footer">
                        <tr>
                          <td class="wrapper" style="padding-top:0;">
                                  
                            <table class="four columns">
                              <tr>
                                <td class="left-text-pad">
                                  <table class="button facebook" style="vertical-align: middle;">
                                    <tr>
                                      <td valign="middle" align="center" style="vertical-align:middle;">
                                        <a href="http://facebook.com/spokanelibrary"><img style="clear:none; display:inline; width:16px; height:16px;" width="16px" height="16px" src="http://news.spokanelibrary.org/hosted/img/icons/16px/facebook.png">&nbsp;Facebook</a>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                                <td class="expander"></td>
                              </tr>
                            </table>

                          </td>
                          <td class="wrapper" style="padding-top:0">

                            <table class="four columns">
                              <tr>
                                <td class="text-pad">
                                  <table class="button twitter" style="vertical-align: middle;">
                                    <tr>
                                      <td valign="middle" style="vertical-align:middle;">
                                        <a href="http://twitter.com/spokanelibrary"><img style="clear:none; display:inline; width:16px; height:16px;" width="16px" height="16px" src="http://news.spokanelibrary.org/hosted/img/icons/16px/twitter.png">&nbsp;Twitter</a>
                                      </td>
                                    </tr>
                                  </table>
                                </td>          
                                <td class="expander"></td>
                              </tr>
                            </table>

                          </td>
                          <td class="wrapper last" style="padding-top:0">

                            <table class="four columns">
                              <tr>
                                <td class="right-text-pad">
                                  <table class="button spokanelibrary" style="vertical-align: middle;">
                                    <tr>
                                      <td valign="middle" style="vertical-align:middle;">
                                        <a href="http://blog.spokanelibrary.org"><img style="clear:none; display:inline; width:16px; height:16px;" width="16px" height="16px" src="http://news.spokanelibrary.org/hosted/img/icons/16px/spl-touch-inverse.png">&nbsp;Library Blog</a>
                                      </td>
                                    </tr>
                                  </table>
                                </td>          
                                <td class="expander"></td>
                              </tr>
                            </table>

                          </td>
                        </tr>
                      </table>

                    </td>
                  </tr>
                  <tr>
                    <td>
                
                      <table class="row footer">
                        <tr>
                          <td class="wrapper" style="padding-top:0;">
                                  
                            <table class="four columns">
                              <tr>
                                <td class="" align="center">
                                  <center>
                                    <p style="text-align:center;">
                                      509.444.5333
                                    </p>
                                  </center>
                                </td>
                                <td class="expander"></td>
                              </tr>
                            </table>

                          </td>
                          <td class="wrapper" style="padding-top:0">

                            <table class="four columns">
                              <tr>
                                <td class="" align="center">
                                  <center>
                                    <p style="text-align:center;">
                                      <a href="mailto:news@spokanelibrary.org">news@spokanelibrary.org</a>
                                    </p>
                                  </center>
                                </td>          
                                <td class="expander"></td>
                              </tr>
                            </table>

                          </td>
                          <td class="wrapper last" style="padding-top:0">

                            <table class="four columns">
                              <tr>
                                <td class="" align="center">
                                  <center>
                                    <p style="text-align:center;">
                                      <a href="http://www.spokanelibrary.org">spokanelibrary.org</a>
                                    </p>
                                  </center>
                                </td>          
                                <td class="expander"></td>
                              </tr>
                            </table>

                          </td>
                        </tr>
                      </table>
                  
                    </td>
                  </tr>
                </table>


                <!-- legal -->
                <table class="row">
                  <tr>
                    <td class="wrapper last">
            
                      <table class="twelve columns">
                        <tr>
                          <td class="muted">
                              <small>
                              You are receiving this email because either you have a Spokane Public Library card, or your email address was registered to receive this newsletter at <a href="http://www.spokanelibrary.org">spokanelibrary.org</a>.
                              Please be assured that the library does not share email information with any other agencies.
                              </small>
                          </td>
                        </tr>
                        <tr>
                          <td align="center">
                            <center>
                              <p style="text-align:center;">
                                <a href="http://news.spokanelibrary.org/subscribe/">Subscribe</a>
                                |
                                <a href="http://news.spokanelibrary.org/privacy/">Your Privacy</a> 
                                | 
                                <a href="http://news.spokanelibrary.org/unsubscribe/?email=%recipient_email%">Unsubscribe</a>
                              </p>
                              <p>
                                <a href="%unsubscribe_url%">auto unsubscribe</a>
                              </p>
                            </center>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>
            
                    </td>
                  </tr>
                </table>


              <!-- content start -->
              
              
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