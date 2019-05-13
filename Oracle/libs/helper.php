<?php 

	// Hàm tạo URL
	function base_url($uri = ''){
	    return 'http://localhost:8080/Oracle/'.$uri;
	}
	 
	// Hàm redirect
	function redirect($url){		
	    header("Location:{$url}",true,301);
	    exit();
	}
	 
	// Hàm lấy value từ $_POST
	function input_post($key){
	    return isset($_POST[$key]) ? trim($_POST[$key]) : false;
	}
	 
	// Hàm lấy value từ $_GET
	function input_get($key){
	    return isset($_GET[$key]) ? trim($_GET[$key]) : false;
	}

	// Hàm lấy value từ $_FILE
	function input_file($key){
		return isset($_FILES[$key]) ? ($_FILES[$key]) : false;
	}
	 
	// Hàm kiểm tra submit
	function is_submit($key){
	    return (isset($_POST['request']) && $_POST['request'] == $key);
	}
	 
	// Hàm show error
	function show_error($error, $key){
	    echo '<span style="color: red">'.(empty($error[$key]) ? "" : $error[$key]). '</span>';
	}

	// Tạo chuỗi query string
	function create_link($uri, $filter = array()){
	    $string = '';
	    foreach ($filter as $key => $val){
	        if ($val != ''){
	            $string .= "&{$key}={$val}";
	        }
	    }
	    return $uri . ($string ? '?'.ltrim($string, '&') : '');
	}

	// Hàm phân trang
	function paging($link, $total_records, $current_page, $limit)
	{    
	    // Tính tổng số trang
	    $total_page = ceil($total_records / $limit);
	     
	    // Giới hạn current_page trong khoảng 1 đến total_page
	    if ($current_page > $total_page){
	        $current_page = $total_page;
	    }
	    else if ($current_page < 1){
	        $current_page = 1;
	    }
	     
	    // Tìm Start
	    $start = ($current_page - 1) * $limit;
	 
	    $html = '';
	     
	    // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
	    if ($current_page > 1 && $total_page > 1){
	        $html .= '<li><a href="'.str_replace('{page}', $current_page-1, $link).'">&laquo;</a></li>';	        
	    }
	 
	    // Lặp khoảng giữa
	    for ($i = 1; $i <= $total_page; $i++){
	        // Nếu là trang hiện tại thì hiển thị thẻ span
	        // ngược lại hiển thị thẻ a
	        if ($i == $current_page){
	            $html .= '<li><span>'.$i.'</span></li>';
	        }
	        else{
	            $html .= '<li><a href="'.str_replace('{page}', $i, $link).'">'.$i.'</a></li>';
	        }
	    }
	 
	    // nếu current_page < $total_page và total_page > 1 mới hiển thị nút next
	    if ($current_page < $total_page && $total_page > 1){
	        $html .= '<li><a href="'.str_replace('{page}', $current_page+1, $link).'">&raquo;</a></li>';	        
	    }
	     	     
	    // Trả kết quả
	    return array(
	        'start' => $start,
	        'limit' => $limit,
	        'html' => $html
	    );
	}

	// Hàm upload file
	function uploadfile($file){
		if($file['error'] != 0){
			return "File lỗi.";
		}
		else
			move_uploaded_file($file['tmp_name'],'../images/'.$file['name']);
			return $file['name'];
	}

	// Hàm upload multi file
	function uploadfiles($files){		
		$hovergallerystring = "";
		for($i = 0;$i<count($files['tmp_name']);++$i){
			if($files['error'][$i] != 0){
				$error[$i] = 'File '.$i.' lỗi';
				continue;
			}				
			move_uploaded_file($files['tmp_name'][$i],'../images/'.$files['name'][$i]);
			$hovergallerystring.= $files['name'][$i]."*";
		}
		if(empty($error)){
			return $hovergallerystring;
		}
		else
			return $error;
	}

	
 ?>