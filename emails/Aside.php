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
          <!-- dateline -->
          <table class="row dateline">
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


                        <!-- selected posts -->
                        <?php if ( !is_null($posts[1]) ) : ?>
                        <tr>
                          <td>
                          <?php 
                          echo SPL_Mailgun_Newsletter::formatPostSelect($posts[1], 'eight columns'); 
                          ?>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <?php endif; ?>

                        <?php if ( !is_null($posts[2]) ) : ?>
                        <tr>
                          <td>
                          <?php 
                          echo SPL_Mailgun_Newsletter::formatPostSelect($posts[2], 'eight columns'); 
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

                        <?php if ( !is_null($posts[5]) ) : ?>
                        <tr>
                          <td>
                          <?php 
                          echo SPL_Mailgun_Newsletter::formatPostSelect($posts[5], 'eight columns'); 
                          ?>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <?php endif; ?>

                        <?php if ( !is_null($posts[6]) ) : ?>
                        <tr>
                          <td>
                          <?php 
                          echo SPL_Mailgun_Newsletter::formatPostSelect($posts[6], 'eight columns'); 
                          ?>
                          </td>
                          <td class="expander"></td>
                        </tr>
                        <?php endif; ?>



                      </table>
                    </td>
                    <td class="wrapper last">
                      <table class="four columns">
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
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>
                  
                    </td>
                  </tr>
                </table>

                <!-- selected posts -->
                
                <?php if ( !is_null($posts[7]) ) : ?>
                <table class="row callout post">
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
                <table class="row callout post">
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
                <table class="row callout post">
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
                <br>
                <br>
                <table class="row footer">
                  <tr>
                    <td class="wrapper">
                            
                      <table class="six columns">
                        <tr>
                          <td class="left-text-pad">

                            <h5>Connect With Us:</h5>

                            <table class="button facebook">
                              <tr>
                                <td>
                                  <a href="http://facebook.com/spokanelibrary">Facebook</a>
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
                            <h5>Contact Us:</h5>
                            <p>Phone: 509.444.5333</p>
                            <p>Email: <a href="mailto:news@spokanelibrary.org">news@spokanelibrary.org</a></p>
                          </td>          
                          <td class="expander"></td>
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
                          <td align="center">
                            <center>
                              <p style="text-align:center;"><a href="#">Your Privacy</a> | <a href="#">Unsubscribe</a></p>
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