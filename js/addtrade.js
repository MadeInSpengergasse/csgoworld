// JavaScript Document


var items_left = [];
var items_right = [];

function addTrade(left, object) {
		if(left === "true"){
			if(items_left.length < 8){
		
			
			items_left.push($(object).attr("data-id"));
			console.log(items_left.length);
			$(object).attr("onClick", "removeTrade(\"true\", this);");
			
			
			//var data_id = document.getElementsByTagName("img")[0].getAttribute("data-id");
			//var data_id = $(object).getAttribute("data-id");
			
			$( "#addtrade_have" ).append($(object));
			
			}
		} else {
			
			if(items_right.length < 8){
		
			
			items_right.push($(object).attr("data-id"));
			console.log(items_right.length);
			$(object).attr("onClick", "removeTrade(\"false\", this);");
			
			$( "#addtrade_want" ).append($(object));
			
			}
		}
}

function submit() {
	
	console.log("Submit called!");
	
	var comment = document.getElementById("comment").value;
	
	if(items_left.length > 0 && items_right.length > 0){
			
			var data_post = {comment: comment, h_1: items_left.shift(), h_2: items_left.shift(), h_3: items_left.shift(), h_4: items_left.shift(), h_5: items_left.shift(), h_6: items_left.shift(), h_7: items_left.shift(), h_8: items_left.shift(), w_1: items_right.shift(), w_2: items_right.shift(), w_3: items_right.shift(), w_4: items_right.shift(), w_5: items_right.shift(), w_6: items_right.shift(), w_7: items_right.shift(), w_8: items_right.shift()};
			
			console.log(data_post);
			
			$.ajax({
				type: "POST",
				url: "trade_insert.php",
				data: data_post,
				success: function(){
					alert("Trade sent!");
					window.location.replace("http://csgoworld.me/trades.php");
				},
				error: function(){
					alert("ERROR!");	
				}
				
			});
			
	} else {
		alert("You must add at least 1 item to each side!");	
	}
}

