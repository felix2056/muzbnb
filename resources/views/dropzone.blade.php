<html>
<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
	<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style>
		.dz-default {
			/*border: 1px solid #F62C0F !important;*/
			/*padding: 10px !important;*/
			/*background: #F62C0F !important;*/
			/*width: 20% !important;*/
			/*border-radius: 20px !important;*/
			/*color: white !important;*/
			/*margin: 0 auto !important;*/
			/*margin-top: 25px !important;*/
			/*font-weight: 600 !important;*/
			
			display: block !important;
			font-family: Montserrat !important;
			font-size: 15px !important;
			color: #fff !important;
			border-color: #F62C0F !important;
			background-color: #F62C0F !important;
			background-image: url(assets/img/icon/cloud_download.svg) !important;
			background-repeat: no-repeat !important;
			background-position: left 55px center !important;
			border-radius: 1em !important;
			margin: 3% auto 0px !important;
			width: 100% !important;
			max-width: 270px !important;
			text-transform: uppercase !important;
			padding: 15px 15px 15px 15px !important;
			border-radius: 25px !important;
			font-weight: 500 !important;
			letter-spacing: 0.5px !important;
			position: relative !important;
			z-index: 1 !important;
		}
		
		#myDropZone {
			border: none !important;
		}
		
		.imgCss {
			width: 120px;
			height: 120px;
			border-radius: 15%;
			display: block;
		}
		
		.mr33 {
			margin-right: 33px;
		}
		
		.rmvBtn {
			margin-left: 16px;
			margin-top: 2px;
		}
	</style>
</head>
<body onload="me()">
<div class="image_upload_div">
	<input type="hidden" value="{{csrf_token()}}" name="authenticity_token">
	<div id="myDropZone" class="dropzone"></div>
	<div class="col-sm-12" id="editImage">
		<div class="col-sm-3"><img style="width: 70%" src="{{asset('images/community 2.png')}}" alt=""></div>
		<div class="col-sm-3"><img style="width: 70%" src="{{asset('images/community 2.png')}}" alt=""></div>
		<div class="col-sm-3"><img style="width: 70%" src="{{asset('images/community 2.png')}}" alt=""></div>
		<div class="col-sm-3"><img style="width: 70%" src="{{asset('images/community 2.png')}}" alt=""></div>
	</div>
</div>

<script>
  Dropzone.autoDiscover = false;
  var me = function () {
    var myDropzone = new Dropzone("div#myDropZone", {
      url: "/uploadDz",
      paramName: "file",
      maxFilesize: 2, // MB
      headers: {
        'X-CSRF-Token': $('input[name="authenticity_token"]').val()
      },
	    init: function () {
		    localStorage.setItem('photoCounter', 0);
		    localStorage.setItem('removeCallbackCount', 0);
            localStorage.setItem('photoCounterServer', 0);

      }
    });

    myDropzone.on("complete", function (file,err) {
        if(!file.accepted)
		{this.removeFile(file); alert("Each file should be less than 2MB");}

	});


    myDropzone.on("addedfile", function (file) {
      var _this = this;
      debugger;
		  /* Maybe display some more file information on your page */
      var removeButton = Dropzone.createElement("<button data-dz-remove " +
        "class='del_thumbnail btn btn-default rmvBtn'>Remove</button>");

      removeButton.addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        var server_file = $(file.previewTemplate).children('.server_file').text();

        var settings = {
          "async": true,
          "crossDomain": true,
          "url": "/removeImages/"+file.name,
          "method": "GET",
          "headers": {
            "cache-control": "no-cache",
            "postman-token": "8c81b1a5-6abf-42db-c949-53b9dc2ac94d"
          }
        }

		  var callbackCounter = localStorage.getItem('removeCallbackCount');
          callbackCounter++;
          localStorage.setItem('removeCallbackCount', callbackCounter);



          $.ajax(settings).done(function (resp) {
              var callbackCounter = localStorage.getItem('removeCallbackCount');
              callbackCounter--;
              localStorage.setItem('removeCallbackCount', callbackCounter);


              console.log(resp);
          var counter = localStorage.getItem('photoCounter');
          var serverCounter = resp.data.length ? resp.data.length : 0;
          counter--;
          localStorage.setItem('photoCounter', counter);
          localStorage.setItem('photoCounterServer', serverCounter);
        });
        
        _this.removeFile(file);
      });
      file.previewElement.appendChild(removeButton);
    });

    myDropzone.on("success", function (file, resp) {
//      alert('completed');
      var counter = localStorage.getItem('photoCounter');
      var serverCounter = resp.data.length ? resp.data.length : 0;
      counter++;
      localStorage.setItem('photoCounter', counter);
      localStorage.setItem('photoCounterServer', serverCounter);
      console.log('local count: '+localStorage.getItem('photoCounter'));
      if(counter>=2)
        $('.photos_error').hide();
    });
  }


  function getParamValue(paramName)
  {
    var url = window.location.search.substring(1); //get rid of "?" in querystring
    var qArray = url.split('&'); //get key-value pairs
    for (var i = 0; i < qArray.length; i++)
    {
      var pArr = qArray[i].split('='); //split key and value
      if (pArr[0] == paramName)
        return pArr[1]; //return value
    }
  }

  var isEdit = getParamValue('edit');
  if (isEdit) {
//    alert(getParamValue('id'))
    console.log(getParamValue('id'));
//    alert('edit case');
    var settings = {
      "async": true,
      "crossDomain": true,
      "url": "/editImages/"+getParamValue('id'),
      "method": "GET",
      "headers": {
        "cache-control": "no-cache",
        "postman-token": "8c81b1a5-6abf-42db-c949-53b9dc2ac94d"
      }
    }

    $.ajax(settings).done(function (response) {
//      alert();
      console.log(response.images);
      var html ='';
      var counter=0;
      $.each(response.images, function (key, val) {
        console.log(key);
        console.log(val.name);
        console.log('F: '+val.is_featured);
        if (parseInt(val.is_featured) == 0) {
            counter++;
            localStorage.setItem('photoCounter', counter);
            localStorage.setItem('photoCounterServer', counter);
          html += "<div class='col-sm-2 text-center' id='dz_" + val.id + "' >" +
            "<img class='imgCss' src='{{asset('images/listings/')}}/" + val.name + "' alt=''> " +
            "<a href='#' class='btn btn-default removeNow mr33'  data-id='" + val.id + "'>Remove</a> " +
            "</div>";
        }
      });
      console.log(html);
      $('#editImage').html(html);
    });
  } else {
    $('#editImage').html('');
  }
  console.log('--->'+getParamValue('edit'))

  $(document.body).on('click', '.removeNow' ,function() {
//    alert();
    id = $(this).data('id');
    console.log(($(this).data('id')));
    var settings = {
      "async": true,
      "crossDomain": true,
      "url": "/deleteListingImages/"+$(this).data('id'),
      "method": "GET",
      "headers": {
        "cache-control": "no-cache",
        "postman-token": "8c81b1a5-6abf-42db-c949-53b9dc2ac94d"
      }
    };

      var callbackCounter = localStorage.getItem('removeCallbackCount');
      callbackCounter++;
      localStorage.setItem('removeCallbackCount', callbackCounter);








      $.ajax(settings).done(function (response) {
      $('#dz_'+id).html('');
              var callbackCounter = localStorage.getItem('removeCallbackCount');
              callbackCounter--;
          var counter = localStorage.getItem('photoCounter');
          counter--;
          localStorage.setItem('photoCounter', counter);

          localStorage.setItem('removeCallbackCount', callbackCounter);

          });
    
  });
  
  
  $(function () {
    $(".dz-remove").on("click", function (e) {
//      alert()
      e.preventDefault();
      e.stopPropagation();

      var imageId = $(this).parent().find(".dz-filename > span").text();

      console.log(imageId)

    });
  })


</script>
</body>
</html>