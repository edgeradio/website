<?php 

// 
// Configuration 
// 
$forum_ids = array(11, 12, 13, 14, 9, 6, 7);        //Forum ID(s) to pull posts from, leave blank to pull from all forums 
$num_posts = 1;        //Number of posts to display 
$num_chars = 50;    //Number of characters to show in the post text 

// 
// Trim text to a certain length 
// 
function phpbb_trim_text(&$text, &$is_trimmed, $number) 
{ 
    if ($number != 0 and strlen($text) > $number) 
    { 
        $text       = substr($text, 0, $number); 
        $is_trimmed = true; 
    } 

    return true; 
} 


// 
// Recent posts 
// 

    $sql = 'SELECT p.post_id, p.topic_id, p.post_subject, p.post_text, p.post_time, u.username 
        FROM ' . POSTS_TABLE . ' p 
            INNER JOIN ' . USERS_TABLE . ' u on (p.poster_id = u.user_id) 
                WHERE p.post_approved = 1 
                    AND ' . $db->sql_in_set('p.forum_id', $forum_ids) . ' 
                ORDER BY p.post_time DESC'; 

    $result = $db->sql_query_limit($sql, $num_posts); 
    $row = $db->sql_fetchrowset($result); 

    for($i = 0; $i < sizeof($row); $i++) 
    { 
        $post_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", 't=' . $row[$i]['topic_id'] . '&amp;p=' . $row[$i]['post_id'] . 'p' . $row[$i]['post_id']); 

        //Prepare text (strip bbcodes and trim it) 
        $row[$i]['post_trimmed'] = false; 
        strip_bbcode($row[$i]['post_text']); 
        phpbb_trim_text($row[$i]['post_text'], $row[$i]['post_trimmed'], $num_chars); 

        $post_text = ''; 
        if ($row[$i]['post_trimmed']) 
        { 
            $post_text = $row[$i]['post_text'] . '...'; 
        } 
        else 
        { 
            $post_text = $row[$i]['post_text']; 
        } 

        echo '<table border="0" width="100%"> 
                <tr> 
                    <td width="100%"><a style="font-size: 14px; text-decoration: none; color: #000000;" href="' . $post_url . '"><b>' . $row[$i]['post_subject'] . '</b></a></td> 
                </tr> 
                <tr> 
                    <td width="100%"><span style="font-size: 11px;"><i>Posted by ' . $row[$i]['username'] . '</i></span></td> 
                </tr> 
                <tr> 
                    <td width="100%"><br>' . $post_text . '</td> 
                </tr> 
            </table>'; 
    } 

    $db->sql_freeresult($result); 


?>