<?php
/* @$send_email_now - Default true and will send emails. For some case the content need to be sent back.
 */

function process_and_send_mail($email, $email_array, $email_key = '', $attachments=array(), $bcc = array(), $fromName='', $fromEmail='', $send_email_now = true) {
    $ci = &get_instance();
    $values_array = array(); 
    $result_array = get_mail_content_and_title($email_key);
   
    foreach ($result_array as $key => $value) {
        $mail_subject = $key;
        $email_body = $value;
    }
    $matches = array();
    preg_match_all("/\{\%([a-z_A-Z0-9]*)\%\}/", $email_body, $matches);
    $variables_array = $matches[1];

    if (count($variables_array) > 0)
        foreach ($variables_array as $key) {
            $values_array[] = $email_array[$key];
        }

    $new_variables_array = array();
    foreach ($variables_array as $variable) {
        $new_variables_array[] = '/\{\%' . $variable . '\%\}/';
    }
    $body_content_first = preg_replace($new_variables_array, $values_array, $email_body);


    //$body_content = make_emailtemplate($body_content_first);
    $body_content = $body_content_first; // this change is made as per the reuirement to change the header and border of email template (13-01-2014 - Active errors 215)

    $matches = array();
    preg_match_all("/\{\%([a-z_A-Z0-9]*)\%\}/", $mail_subject, $matches);
    $variables_array = $matches[1];

    $values_array = array();
    if (count($variables_array) > 0)
        foreach ($variables_array as $key) {
            $values_array[] = $email_array[$key];
        }

    $new_variables_array = array();
    foreach ($variables_array as $variable) {
        $new_variables_array[] = '/\{\%' . $variable . '\%\}/';
    }
    $mail_subject = preg_replace($new_variables_array, $values_array, $mail_subject);
    $mail_subject =  html_entity_decode($mail_subject, ENT_QUOTES, 'UTF-8'); // added encoding flags
   
    if($send_email_now == true){
        return (send_mail($email, $fromName, $mail_subject, $body_content, $fromEmail, $attachments, $bcc)) ? true : false;
    }else{
        return $email_content_return = array('subject' => $mail_subject, 'content' => $body_content);
    }
    return false;
}

function send_mail($to_email, $from_name='', $subject='', $body_content='', $from_email='', $bcc = array()) {   //$attachment = array(), 
            
            $server_email = "-f".$from_email;
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: '.$from_name.'<'.$from_email.">\r\n";
            if(!empty($bcc['cc'])){
                $headers .= 'Cc: '.$bcc['cc']. "\r\n";
            }
            if(!empty($bcc['bcc'])){
                $headers .= 'Bcc: '.$bcc['bcc']. "\r\n";
            }
            $headers .= 'Reply-To: '.$from_email."\r\n" ;
            $headers .= 'X-Mailer: PHP/' . phpversion();
            
            $mail = mail($to_email, $subject, $body_content, $headers,$server_email);
            if($mail){
              return TRUE;
            }else{
              return FALSE;
            }
            
        /*else{ 
            $ci =& get_instance();
            $ci->load->library('email');

            $ci->email->protocol = $ci->config->item('protocol');
            $ci->email->smtp_host = $ci->config->item('smtp_host');
            $ci->email->smtp_timeout = $ci->config->item('smtp_timeout');
            $ci->email->smtp_user = $ci->config->item('smtp_user');
            $ci->email->smtp_pass = $ci->config->item('smtp_password');
            $ci->email->mailtype = $ci->config->item('mailtype');
            //$ci->email->set_newline("\r\n");
            //$ci->email->set_crlf = "\r\n";
            $ci->email->initialize();


            $from_name = ($from_name == '') ? $ci->config->item('smtp_from_name') : $from_name;
            $from_email = ($from_email == '') ? $ci->config->item('smtp_from') : $from_email;
            $ci->email->from($from_email, $from_name);
            $ci->email->to($to_email);
            if (count($bcc)) {
                $ci->email->bcc($bcc);
            }

            //$ci->email->set_mailtype('html');
            $ci->email->subject($subject);
        //    return true; exit;
        //    echo $subject;
        //    print $body_content;
        //    exit;
            $ci->email->message($body_content); 
            if (count($attachment)) {
                foreach ($attachment as $attach) {
                    $ci->email->attach($attach);
                }
            }
            $send = $ci->email->send();
            //p($ci->email->print_debugger());exit;
           // echo $ci->email->print_debugger();die;
            //if($to_email == 'cindie_charming@mail.com')
                //echo $ci->email->print_debugger();die;
           // $ci->email->clear(TRUE);
            //echo $send ? 'sent' : 'failed';
            return ($send) ? true : false;
        }
        * */
}

function get_mail_content_and_title($email_key = '') { 
    $ci = &get_instance();
    $ci->db->select('subject AS TITLE, template AS BODY_CONTENT');
    $ci->db->from('email_template');
    $ci->db->where('email_key', $email_key);
    $select_query = $ci->db->get(); 
    if (0 < $select_query->num_rows()) {
        foreach ($select_query->result() as $row) {
            $result_array[$row->TITLE] = $row->BODY_CONTENT;
        }
        return $result_array;
    } else {
        return FALSE;
    }
}
function make_emailtemplate($body_content) {

    $ci = &get_instance();

    $body_content = '<table cellpadding="0" cellspacing="0" border="0" width="90%" style="background-color: #5a738e; background-repeat: repeat-x; border-radius: 2px; -webkit-border-radius:2px;-moz-border-radius:2px;">                          
                          
                         <thead>
                               <tr>
                                 <td align="left" width="90%" style="height:43px; background:#5a738e; color: #FFFFFF; padding:0 0 0 25px; text-align:left; border-radius: 2px; -webkit-border-radius:2px;-moz-border-radius:2px; "><img alt="Transaction Stairway" title="Transaction Stairway" src="'.$ci->config->item('images').'logo.jpg"></td>

                               </tr>
                           </thead>                           
   							<tbody>
                                <tr>
                                    <td colspan="2" style="padding:30px; text-align:center; vertical-align:top; border-top:1px solid #DDDCDC; border-left:1px solid #DDDCDC; border-right:1px solid #DDDCDC; border-bottom:1px solid #DDDCDC;">
                                    '. $body_content .'
                                    </td>
                                </tr>
                           </tbody>
                          <tfoot>
                                <tr>
                                 <td width="90%" style="height:43px; background:#5a738e; color: #FFFFFF; padding:0 25px 0 25px; text-align:right; border-radius: 2px; -webkit-border-radius:2px;-moz-border-radius:2px; ">© CRM All Rights Reserved.</td>
                               </tr>
                          </tfoot>
           </table>';   
    return $body_content;
}
