Dropzone.options.addDocuments={
	maxFilesize:2,
	acceptedFiles: 'image/*',
	success: function(file,response){
		if(file.status=='success'){
			handleDropzoneFileUpload.handleSuccess(response);
		}
		else{
			handleDropzoneFileUpload.handleError(response);
		}
	}
};

var handleDropzoneFileUpload={
	handleError: function(response){
		console.log(response);
	},
	handleSuccess:function(response){
		var imageList=$('.document-images ul');
		var imageSrc='/documents/thumbs/'+response.file_name;
		var id=response.id;
		$(imageList).append('<li><a href="'+imageSrc+'"><img src="'+imageSrc+'"></a><div class="label"><a href="/documents/edit/'+id+'">Edit</a></div></li>');
	}
};
