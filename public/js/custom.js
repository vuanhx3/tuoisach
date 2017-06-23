//####################################################
// $uery Handle
//####################################################
(function($)
{
	$(document).ready(function()
	{
		
		// Ckeditor
		$('.editor').each(function()
		{
			var id = $(this).attr('id');
			
			var config = $(this).attr('_config');
			config = (config) ? JSON.parse(config) : {};
			
			CKEDITOR.replace(id, config).on("change", function()
			{
				CKEDITOR.instances[id].updateElement();
			});
		});
		
		// Đăng xuất
		$('a.verify_logout').click(function(){
			if(!confirm('Bạn có chắc chắn muốn đăng xuất ?'))
			{
				return false;
			}
		});
		
		//Xác thực xóa dữ liệu
		$('a.verify_pd_del_cart').click(function(){
			if(!confirm('Bạn chắc chắn xóa toàn bộ thông tin giỏ hàng của bạn ?'))
			{
				return false;
			}
		});
		
		//sản phẩm hết hàng
		$('a.verify_number_pd').click(function(){
			if(!confirm('Xin lỗi Quí Khách hiện tại Thực phẩm này đang hết hàng, bạn có thể chọn thực phẩm cùng chủng loại khác ?'))
			{
				return false;
			}
		});
		
		// Đăng xuất
		$('a.verify_logout').click(function(){
			if(!confirm('Bạn có chắc chắn muốn đăng xuất ?'))
			{
				return false;
			}
		});
		
		
		
	});
})(jQuery);


//####################################################
// Main function
//####################################################

/**
 * Chuyen tieng viet khong dau
 */
function convert_vi_to_en(str) 
{  
	  str= str.toLowerCase();  
	  str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");  
	  str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");  
	  str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");  
	  str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");  
	  str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");  
	  str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");  
	  str= str.replace(/đ/g,"d");  
	  str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,"-"); 
	  /* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */ 
	  str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1- 
	  str= str.replace(/^\-+|\-+$/g,"");  
	  //cắt bỏ ký tự - ở đầu và cuối chuỗi  
	  return str;  
}  



/**
 * An pages khi ko co chia trang
 */
function auto_check_pages(t)
{
	if (t.find('a')[0] == undefined)
	{
		t.remove();
	}
}

/**
 * Tim kiem va thay the chuoi
 */
function str_replace (search, replace, subject, count) 
{
	
	  var i = 0,
	    j = 0,
	    temp = '',
	    repl = '',
	    sl = 0,
	    fl = 0,
	    f = [].concat(search),
	    r = [].concat(replace),
	    s = subject,
	    ra = Object.prototype.toString.call(r) === '[object Array]',
	    sa = Object.prototype.toString.call(s) === '[object Array]';
	  s = [].concat(s);
	  if (count) {
	    this.window[count] = 0;
	  }

	  for (i = 0, sl = s.length; i < sl; i++) {
	    if (s[i] === '') {
	      continue;
	    }
	    for (j = 0, fl = f.length; j < fl; j++) {
	      temp = s[i] + '';
	      repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
	      s[i] = (temp).split(f[j]).join(repl);
	      if (count && s[i] !== temp) {
	        this.window[count] += (temp.length - s[i].length) / f[j].length;
	      }
	    }
	  }
	  return sa ? s : s[0];
}

