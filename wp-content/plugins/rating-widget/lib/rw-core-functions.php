<?php
/* For servers without mb string support.
---------------------------------------------------------------------------------------------------------------*/
if (!function_exists("mb_strlen"))
{
    function mb_strlen($str){ return strlen($str); }
    
    if (!function_exists("mb_substr"))
    {
        function mb_substr($str, $start, $length){ return substr($str, $start, $length); }
    }
    
    if (!function_exists("mb_convert_to_utf8"))
    {
        function mb_convert_to_utf8($str){ return $str; }
    }
}
else
{
    function mb_convert_to_utf8($str){ return mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str)); }
}

/* For servers without transient support.
---------------------------------------------------------------------------------------------------------------*/
if (!function_exists('get_transient'))
{
    function get_transient($transient)
    {
        return false;
    }
    
    function set_transient($transient, $value, $expiration)
    {
        return false;
    }
}

if (!function_exists('get_admin_url'))
{
    function get_admin_url($blog_id = null, $path = '')
    {
        echo site_url() . '/wp-admin/' . trim($path, '/');
    }
}

if (!function_exists('bbp_get_user_display_name'))  
{
    function bbp_get_user_display_name($author_id)
    {
        // Try to get a display name
        $author_name = get_the_author_meta( 'display_name', $author_id );

        // Fall back to user login
        if ( empty( $author_name ) ) {
            $author_name = get_the_author_meta( 'user_login', $author_id );
        }
        
        return $author_name;
    }
}
?>
