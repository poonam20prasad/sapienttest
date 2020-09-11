<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<html>
    <head>
        <meta charset="UTF-8">
        <title>Space-X</title>
    </head>
    <body>
        
        <!-- Content is blank by default -->
        <div class="container">
			<div class="filters" >
				<p>Filters</p>
				
				<p class="subfilter">Launch Year</p>
				<hr/>
				<?php for($i=2006;$i<=2020;$i++) { ?>
				<button class='yearfilter' value="<?php echo $i ; ?>"><?php echo $i ; ?></button>
				<?php } ?>
				
				<p class="subfilter">Successful Land</p>
				<hr/>
				<button class='landfilter' value="true">True</button>
				<button class='landfilter' value="false">False</button>
				
				<p class="subfilter">Successful Launching</p>
				<hr/>
				<button class='launchfilter' value="true">True</button>
				<button class='launchfilter' value="false">False</button>
				
				<!--<hr/>
				<button class='resetfilter' value="reset">Reset</button>-->
				<hr/>
				<label id="filterapplied"> Applied Filters </label>
				<button id='appliedyear' value="" style="display:none" ><i class="fa fa-window-close"></i></button>
				<button id='appliedland' value="" style="display:none" ><i class="fa fa-window-close"></i></button>
				<button  id='appliedlaunch' value="" style="display:none" ><i class="fa fa-window-close"></i></button>
				
				
			</div>
			<style>
			.spaceinfo{
				float:left;
				margin:5px;
				padding:5px;
				width: 22%;
				text-align: justify; 
				background:white;
			}
			.content{
				float:left;
				width: 75%;
				
			}
			body,.container{
				background:grey;
			}
			.filters{
				float:left;
				margin:5px;
				padding:10px;
				width: 150px;
				text-align: justify; 
				background:white;
			}
			.icon{
				text-align:center;
				width: 80%;
				height:100px;
				margin-left:10%;
			}
			.name{
				font-weight:bold;
				color:aquamarine;
			}
			.head{
				font-weight:bold;
			}
			.data{
				color:gray;
			}
			@media screen and (max-width: 700px)  {
			  .filters{
					float:left;
					margin:5px;
					padding:10px;
					width: 100%;
					text-align: justify; 
					background:white;
				}
				.spaceinfo{
					float:left;
					margin:5px;
					padding:5px;
					width: 100%;
					text-align: justify; 
					background:white;
				}
			}
			@media only screen and (max-width:1024px) and (min-width: 700px)  {
			  .filters{
					float:left;
					margin:5px;
					padding:10px;
					width: 40%;
					text-align: justify; 
					background:white;
				}
				.spaceinfo{
					float:left;
					margin:5px;
					padding:5px;
					width: 40%;
					text-align: justify; 
					background:white;
				}
			}
			@media only screen and (max-width:1440px) and (min-width: 10400px)  {
			  .spaceinfo{
					float:left;
					margin:5px;
					padding:5px;
					width: 22%;
					text-align: justify; 
					background:white;
				}
				.content{
					float:left;
					width: 80%;
					
				}
				body,.container{
					background:grey;
				}
				.filters{
					float:left;
					margin:5px;
					padding:10px;
					width: 150px;
					text-align: justify; 
					background:white;
				}
			}
			</style>
			<div class="content" >
				
			</div>
		
		
		</div>
        
        <!-- Include the JQuery library -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script>
        //When the page has loaded.
        $( document ).ready(function(){
			resetfilter();
			$('.resetfilter').click(function(){
				resetfilter();
			});
			$("#filterapplied").css("display", "none");
			//alert( $('#appliedyear').val())
			
			
			$('.allfilter').click(function(){
				var api_path='https://api.spaceXdata.com/v3/launches?limit=100&launch_success=true&land_success=true&launch_year=2014';
				
				getContent(api_path);
			});
			
			
			
			$('.yearfilter').click(function(){
				$("#appliedyear").append(this.value);
				$("#appliedyear").val(this.value);
				$("#appliedyear").css("display", "block");
				applyfilter();
			});
			$('.landfilter').click(function(){
				$("#appliedland").append(this.value);
				$("#appliedland").val(this.value);
				$("#appliedland").css("display", "block");

				applyfilter();
			});
			$('.launchfilter').click(function(){
				$("#appliedlaunch").append(this.value);
				
				$("#appliedlaunch").val(this.value);
				$("#appliedlaunch").css("display", "block");
				applyfilter();
			});
			$('#appliedyear').click(function(){
				this.value = "";
				$("#appliedyear").css("display", "none");
				applyfilter();

			});
			$('#appliedland').click(function(){
				this.value = "";
				$("#appliedland").css("display", "none");
				applyfilter();

			});
			$('#appliedlaunch').click(function(){
				this.value = "";
				$("#appliedlaunch").css("display", "none");
				applyfilter();

			});
			function applyfilter(){
				var api_path = 'https://api.spaceXdata.com/v3/launches?limit=100';
				if (!$('#appliedyear').is(':empty') && $('#appliedyear').val()!='') { 
					year=$('#appliedyear').val();
					
					$("#filterapplied").css("display", "block");

					api_path=api_path+'&launch_year='+year;
				}
				//alert($('#appliedland').val());
				
				if ($('#appliedland').val()!='') { 
					//alert('hello');
					land=$('#appliedland').val();
					$("#filterapplied").css("display", "block");
					api_path=api_path+'&land_success='+land;
				} 
				if ($('#appliedlaunch').val()!='') { 
					//alert($('#appliedlaunch').val());
					launch=$('#appliedlaunch').val();
					$("#filterapplied").css("display", "block");
					api_path=api_path+'&launch_success='+launch;
				}
				alert(api_path);
				
				getContent(api_path);
			}
			
			function resetfilter(){
				var api_path = 'https://api.spaceXdata.com/v3/launches?limit=100';
				alert(api_path);
				getContent(api_path);
				
			}
			
			function getContent(path){
            //Perform Ajax request.
            $.ajax({
                url: path,
                type: 'get',
				//dataType : "json",

                success: function(data){
                    //If the success function is execute,
                    //then the Ajax request was successful.
                    //Add the data we received in our Ajax
                    //request to the "content" div.
                   //var data = $.parseJSON(data);
				   /*for (const [key, value] of Object.entries(data)) {
					  console.log(key, value);

					}*/
					var content = '';
					$.each(data, function(i){
							 var mission_id = (data[i].mission_id!='')?data[i].mission_id:'n/a';
							var spaceinfo='<div class="spaceinfo">';
							spaceinfo+='<img class="icon" src="'+data[i].links.mission_patch+'" />';
							spaceinfo+='<div class="name">'+data[i].mission_name+' #'+data[i].flight_number+'</div>';
							spaceinfo+='<div class="info">';
							spaceinfo+='<p><div class="head">Mission Ids:</div><div class="data">'+mission_id+'</div></p>';
							spaceinfo+='<p><div class="head">Launch Year:</div><div class="data">'+data[i].launch_year+'</div></p>';
							spaceinfo+='<p><div class="head">Succesful Launch:</div><div class="data">'+data[i].launch_success+'</div></p>';
							spaceinfo+='<p><div class="head">Succesful Landing:</div><div class="data">'+data[i].rocket.first_stage.cores[0].land_success+'</div></p>';
							spaceinfo+='</div>';
							spaceinfo+='</div>';
							content+=spaceinfo;
							
						  
						});
						$('.content').html(content);
					  
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Ajax request failed: ' + xhr.responseText;
                    $('#content').html(errorMsg);
                  }
            });
			}
        });
        </script>
    </body>
</html>