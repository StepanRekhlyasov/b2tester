(function($) {
	class B2Tester {
		fetchPosts = () => {
			$.ajax({
				url: "/ajax.php",
				method: "POST",
				data: { action : 'b2tester_fetch', mode: 'native' }
			}).done((data) => {
				this.render(data)
			})
		}
		render = (data) => {
			data.forEach((row, index)=>{
				if(row.post_content){
					$('body').append('<div style="margin:50px;">'+row.post_content+'</div>')
				}
			})
		}
	}
	$(document).on('ready', ()=>{
		const b2tester = new B2Tester();
		b2tester.fetchPosts()
	})
})(jQuery);
