<?php
@session_start();
if(isset($_SESSION['post_id'])){unset($_SESSION['post_id']);}
if(isset($_SESSION['post_title'])){unset($_SESSION['post_title']);}
if(isset($_SESSION['post_content'])){unset($_SESSION['post_content']);}
if(isset($_SESSION['_shipping_option'])){unset($_SESSION['_shipping_option']);}
if(isset($_SESSION['_campain_valid_from'])){unset($_SESSION['_campain_valid_from']);}
if(isset($_SESSION['_campain_valid_to'])){unset($_SESSION['_campain_valid_to']);}
if(isset($_SESSION['_regular_price'])){unset($_SESSION['_regular_price']);}
unset($_SESSION['design']);
unset($_SESSION['style_na']);
unset($_SESSION['base_q']);
unset($_SESSION['proid']);
unset($_SESSION['proprice']);
unset($_SESSION['post_name']);
unset($_SESSION['front_print_area']);
unset($_SESSION['back_print_area']);
?>