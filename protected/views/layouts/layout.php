<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php if ( ! empty($this->metaTitle)) $this->pageTitle = $this->metaTitle; ?>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <meta name="description" content="<?php echo CHtml::encode($this->metaDescription); ?>" />
    <meta name="keywords" content="<?php echo CHtml::encode($this->metaKeywords); ?>" />
    <link href="/css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div id="layout">
        <!-- header starts here-->
        <div id="header">
            <div class="inner">
                <div id="head_left">
                    <div class="logo"><a href="/"><img src="/images/aizietziedi_logo1.gif" width="215" height="29" alt="Diennakts ziedu un dāvanu piegāde" /></a>
                        <div style="margin-top:10px;"><img src="/images/aizietziedi_logo2.gif" width="195" height="39" alt="Diennakts ziedu un dāvanu piegāde" /></div></div>
                </div>
                <div id="head_center">
                    <ul class="lang">
                        <?php if (Yii::app()->language == 'lv'): ?><li class="current">LAT</li><?php else: ?><li><a href="<?php echo $this->link['lv']; ?>">LAT</a></li><?php endif; ?>
                        <?php if (Yii::app()->language == 'ru'): ?><li class="current">RUS</li><?php else: ?><li><a href="<?php echo $this->link['ru']; ?>">RUS</a></li><?php endif; ?>
                    </ul>
                    <div><img src="/images/phone.png" width="281" height="61" alt="Diennakts telefons" /></div>
                </div>
                <div id="head_right">
                    <table class="picto">
                        <tr>
                            <td><ul class="currency"><li class="current">LVL</li><li><a href="#">EUR</a></li></ul></td>
                            <td><div class="over-cart"><div class="cart"><img src="/images/shop_cart.png" width="22" height="20" alt="pirkumu grozs" /> <a href="#">Pirkumu grozs</a></div></div></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- header ends here-->
        <div id="head-banner">
            <div id="top-banner">
                <div class="wrap">
                    <div id="banner">
                        <div class="inner rc5"><img src="/images/top_banner.jpg" width="900" height="151" ></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- body part starts here-->
        <div id="page-body">
            <div class="inner">
                <table class="body-table">
                    <tr>
                        <td class="page-left">
                            <div>
                                <?php
                                $this->widget('zii.widgets.CMenu', array(
                                    'items' => $this->categories['items'],
                                    'activeCssClass' => 'current',
                                    'activateParents' => true,
                                    'submenuHtmlOptions' => array(
                                        'class' => 'submenu'
                                    ),
                                    'htmlOptions' => array(
                                        'class' => 'navigation',
                                    )
                                ));
                                ?>
                            </div>
                        </td>
                        <!--Page right -->	  
                        <td>
                            <table class="center">
                                <tr>
                                    <td class="content">
                                        <div class="wrap">
                                            <table class="flowers">
                                                <tr>
                                                    <td class="border">
                                                        <div><img src="/images/fl1.jpg" width="220" height="220" alt="fl1" /></div>
                                                        <div class="fl-title"><a href="product.html">Pušķis mīļākai</a></div>
                                                        <div class="price">20.00 Ls</div>
                                                    </td>
                                                    <td style="width:15px;">&nbsp;</td>
                                                    <td class="border">
                                                        <div><a href=""><a href=""><img src="/images/fl2.jpg" width="220" height="220" alt="fl1" /></a></div>
                                                        <div class="fl-title"><a href="">Pušķis mīļākai</a></div>
                                                        <div class="price">20.00 Ls</div>
                                                    </td>
                                                </tr>
                                                <tr><td colspan="3" style="height:15px;"></td></tr>
                                                <tr>
                                                    <td class="border">
                                                        <div><img src="/images/fl3.jpg" width="220" height="220" alt="fl1" /></div>
                                                        <div class="fl-title"><a href="">Pušķis mīļākai</a></div>
                                                        <div class="price">20.00 Ls</div>
                                                    </td>
                                                    <td style="width:15px;">&nbsp;</td>
                                                    <td class="border">
                                                        <div><a href=""><a href=""><img src="/images/fl1.jpg" width="220" height="220" alt="fl1" /></a></div>
                                                        <div class="fl-title"><a href="">Pušķis mīļākai</a></div>
                                                        <div class="price">20.00 Ls</div>
                                                    </td>
                                                </tr>
                                                <tr><td colspan="3" style="height:15px;"></td></tr>
                                                <tr>
                                                    <td class="border">
                                                        <div><img src="/images/fl3.jpg" width="220" height="220" alt="fl1" /></div>
                                                        <div class="fl-title"><a href="">Pušķis mīļākai</a></div>
                                                        <div class="price">20.00 Ls</div>
                                                    </td>
                                                    <td style="width:15px;">&nbsp;</td>
                                                    <td class="border">
                                                        <div><a href=""><a href=""><img src="/images/fl1.jpg" width="220" height="220" alt="fl1" /></a></div>
                                                        <div class="fl-title"><a href="">Pušķis mīļākai</a></div>
                                                        <div class="price">20.00 Ls</div>
                                                    </td>
                                                </tr>
                                                <tr><td colspan="3" style="height:15px;"></td></tr>
                                                <tr>
                                                    <td class="border">
                                                        <div><img src="/images/fl3.jpg" width="220" height="220" alt="fl1" /></div>
                                                        <div class="fl-title"><a href="">Pušķis mīļākai</a></div>
                                                        <div class="price">20.00 Ls</div>
                                                    </td>
                                                    <td style="width:15px;">&nbsp;</td>
                                                    <td class="border">
                                                        <div><a href=""><a href=""><img src="/images/fl1.jpg" width="220" height="220" alt="fl1" /></a></div>
                                                        <div class="fl-title"><a href="">Pušķis mīļākai</a></div>
                                                        <div class="price">20.00 Ls</div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                    <td class="page-right">
                                        <div class="r-banner"><img src="/images/ban1.jpg" /></div>
                                        <div class="r-banner"><img src="/images/ban2.jpg" /></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- end body part-->
            
        <div id="footer">
            <div class="inner">
                <table class="foot-table">
                    <tr>
                        <td class="left"></td>
                        <td class="middle">
                            <div class="bmenu">
                                <?php
                                $this->widget('zii.widgets.CMenu', array(
                                    'items' => $this->menu['items'],
                                    'id' => 'navigation-info',
                                    'activeCssClass' => 'current',
                                    'activateParents' => true,
                                    'htmlOptions' => array(
                                        'class' => 'bot-menu',
                                    )
                                ));
                                ?>
                            </div>
                        </td>
                        <td class="right"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/js/rc.js"></script>
</body>
</html>


