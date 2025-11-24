$(document).ready(function(){
	$.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });

	$('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    }) 
   

   $('.dropify').dropify();


   $('#description').summernote(
      {
        height: 150,
        focus: false
      }
    );

    var base_url = localStorage.getItem('base_url');


     var ajax_url = '';
     
     var type= '';
 
    var categoryTable = $('#category-table').DataTable({
        searching: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        stateSave: true,
        ajax: {
          url: base_url+"/categories",
        },

        columns: [
            {data: 'category_name', name: 'category_name'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
   

   var countryTable = $('#country-table').DataTable({
        searching: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        stateSave: true,
        ajax: {
          url: base_url+"/countries",
        },

        columns: [
            {data: 'country_name', name: 'country_name'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


    var scheduleTable = $('#schedule-table').DataTable({
        searching: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        stateSave: true,
        ajax: {
          url: base_url+"/schedule",
        },

        columns: [
            {data: 'schedule_name', name: 'schedule_name'},
            {data: 'image', name: 'image'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


    var socialMediaTable = $('#socialmedia-table').DataTable({
        searching: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        stateSave: true,
        ajax: {
          url: base_url+"/socialmedia",
        },

        columns: [
            {data: 'social_media_name', name: 'social_media_name'},
            {data: 'social_media_url', name: 'social_media_url'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


    var podcast = $('#podcast-table').DataTable({
        searching: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        stateSave: true,
        ajax: {
          url: base_url+"/podcast",
        },

        columns: [
            {data: 'name', name: 'name'},
            {data: 'logo', name: 'logo'},
            {data: 'link', name: 'link'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

   var radioTable = $('#radio-table').DataTable({
        searching: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        stateSave: true,
        ajax: {
          url: base_url+"/radios",
          data: function (d) {
                d.status = $('#selected_radio_status').val(),
                d.category_id = $('#selected_category_id').val(),
                d.country_id = $('#selected_country_id').val(),
                d.search = $('.dataTables_filter input').val()
            }
        },

        columns: [
            {data: 'radio_name', name: 'radio_name'},
            {data: 'category', name: 'category'},
            {data: 'country', name: 'country'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


   $('.filter-radio').click(function(e){
        e.preventDefault();
        radioTable.draw(); 
    });


   var musicTable = $('#music-table').DataTable({
        searching: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        stateSave: true,
        ajax: {
          url: base_url+"/musics",
        },

        columns: [
            {data: 'title', name: 'title'},
            {data: 'category_name', name: 'category_name'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


   $(document).on('click', '#status-music-update', function(){
         var music_id = $(this).data('id');
         var isMusicchecked = $(this).prop('checked');
         var status_val = isMusicchecked ? 'Active' : 'Inactive'; 
         $.ajax({

                     url: base_url+"/music-status-update",
                     type:"POST",
                     data:{'music_id':music_id, 'status':status_val},
                     dataType:"json",
                     success:function(data) {

                        toastr.success(data.message);

                        $('.data-table').DataTable().ajax.reload(null, false);

                     },
                            
        });
    });



     var videoTable = $('#video-table').DataTable({
        searching: true,
        processing: true,
        serverSide: true,
        ordering: false,
        responsive: true,
        stateSave: true,
        ajax: {
          url: base_url+"/videos",
        },

        columns: [
            {data: 'title', name: 'title'},
            {data: 'category', name: 'category'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


     $(document).on('click', '.delete-video', function(e){
        e.preventDefault();
        var int_video_id = $(this).data('id');
          if(confirm('Do you want to delete this?'))
          {
              ajax_url = base_url+"/videos/"+int_video_id;
             $.ajax({

                     url: ajax_url,
                     type:"DELETE",
                     dataType:"json",
                     success:function(data) {
                        $('.data-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);

                     },
                            
                });
          }
    });



   $(document).on('click', '.delete-music', function(e){
        e.preventDefault();
        var int_music_id = $(this).data('id');
          if(confirm('Do you want to delete this?'))
          {
              ajax_url = base_url+"/musics/"+int_music_id;
             $.ajax({

                     url: ajax_url,
                     type:"DELETE",
                     dataType:"json",
                     success:function(data) {
                        $('.data-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);

                     },
                            
                });
          }
    });


    $(document).on('click', '.delete-category', function(e){
    	e.preventDefault();
    	var int_category_id = $(this).data('id');
    	  if(confirm('Do you want to delete this?'))
	      {
	          ajax_url = base_url+"/categories/"+int_category_id;
	         $.ajax({

	                 url: ajax_url,
	                 type:"DELETE",
	                 dataType:"json",
	                 success:function(data) {
	                    $('.data-table').DataTable().ajax.reload(null, false);
	                    toastr.success(data.message);

	                 },
	                        
	            });
	      }
    });


    $(document).on('click', '.delete-country', function(e){
        e.preventDefault();
        var int_country_id = $(this).data('id');
          if(confirm('Do you want to delete this?'))
          {
              ajax_url = base_url+"/countries/"+int_country_id;
             $.ajax({

                     url: ajax_url,
                     type:"DELETE",
                     dataType:"json",
                     success:function(data) {
                        $('.data-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);

                     },
                            
                });
          }
    });

    $(document).on('click', '.delete-socialmedia', function(e){
        e.preventDefault();
        var int_socialmedia_id = $(this).data('id');
          if(confirm('Do you want to delete this?'))
          {
              ajax_url = base_url+"/socialmedia/"+int_socialmedia_id;
             $.ajax({

                     url: ajax_url,
                     type:"DELETE",
                     dataType:"json",
                     success:function(data) {
                        $('.data-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);

                     },
                            
                });
          }
    });

    $(document).on('click', '.delete-podcast', function(e){
        e.preventDefault();
        var int_podcast_id = $(this).data('id');
          if(confirm('Do you want to delete this?'))
          {
              ajax_url = base_url+"/podcast/"+int_podcast_id;
             $.ajax({

                     url: ajax_url,
                     type:"DELETE",
                     dataType:"json",
                     success:function(data) {
                        $('.data-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);

                     },
                            
                });
          }
    });

    $(document).on('click', '.delete-schedule', function(e){
        e.preventDefault();
        var int_schedule_id = $(this).data('id');
          if(confirm('Do you want to delete this?'))
          {
              ajax_url = base_url+"/schedule/"+int_schedule_id;
             $.ajax({

                     url: ajax_url,
                     type:"DELETE",
                     dataType:"json",
                     success:function(data) {
                        $('.data-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);

                     },
                            
                });
          }
    });


    $(document).on('click', '#status-category-update', function(){
         var category_id = $(this).data('id');
         var isCategorychecked = $(this).prop('checked');
         var status_val = isCategorychecked ? 'Active' : 'Inactive'; 
         $.ajax({

                     url: base_url+"/category-status-update",
                     type:"POST",
                     data:{'category_id':category_id, 'status':status_val},
                     dataType:"json",
                     success:function(data) {

                        toastr.success(data.message);

                        $('.data-table').DataTable().ajax.reload(null, false);

                     },
                            
        });
    });


    $(document).on('click', '#status-video-update', function(){
         var video_id = $(this).data('id');
         var isVideochecked = $(this).prop('checked');
         var status_val = isVideochecked ? 'Active' : 'Inactive'; 
         $.ajax({

                     url: base_url+"/video-status-update",
                     type:"POST",
                     data:{'video_id':video_id, 'status':status_val},
                     dataType:"json",
                     success:function(data) {

                        toastr.success(data.message);

                        $('.data-table').DataTable().ajax.reload(null, false);

                     },
                            
        });
    }); 


    $(document).on('click', '#status-country-update', function(){
         var country_id = $(this).data('id');
         var isCountrychecked = $(this).prop('checked');
         var status_val = isCountrychecked ? 'Active' : 'Inactive'; 
         $.ajax({

                     url: base_url+"/country-status-update",
                     type:"POST",
                     data:{'country_id':country_id, 'status':status_val},
                     dataType:"json",
                     success:function(data) {

                        toastr.success(data.message);

                        $('.data-table').DataTable().ajax.reload(null, false);

                     },
                            
        });
    });


    $(document).on('click', '#status-radio-update', function(){
         var radio_id = $(this).data('id');
         var isRadiochecked = $(this).prop('checked');
         var status_val = isRadiochecked ? 'Active' : 'Inactive'; 
         $.ajax({

                     url: base_url+"/radio-status-update",
                     type:"POST",
                     data:{'radio_id':radio_id, 'status':status_val},
                     dataType:"json",
                     success:function(data) {

                        toastr.success(data.message);

                        $('.data-table').DataTable().ajax.reload(null, false);

                     },
                            
        });
    });


    $(document).on('click', '.delete-radio', function(e){
        e.preventDefault();
        var int_radio_id = $(this).data('id');
          if(confirm('Do you want to delete this?'))
          {
              ajax_url = base_url+"/radios/"+int_radio_id;
             $.ajax({

                     url: ajax_url,
                     type:"DELETE",
                     dataType:"json",
                     success:function(data) {
                        $('.data-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.message);

                     },
                            
                });
          }
    });
    

    $(document).on('click', '.reset-filter', function(e){
        if(confirm('Do you want to reset?'))
        {
            window.location.reload();
        }
    });
    
});

