

/**
 * @author Admin
 * 
 * Jan 17, 2015
 * 
 * Confirm Delete Item
 */
function confirm_delete(message) {
	
	if (confirm(message)) {
		
		return true;
	}
	return false;
}
function setTinymce() {
    tinymce.init({
        selector: "textarea.tinymce",
        forced_root_block : "",
        force_br_newlines : true,
        force_p_newlines : false,
        relative_url: false,
        remove_script_host: false,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen media",
            "insertdatetime media table contextmenu paste responsivefilemanager textcolor"
        ],

        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | styleselect formatselect fontselect fontsizeselect | forecolor backcolor",
        entity_encoding : "raw",
        relative_urls: false,
        external_filemanager_path: "/3rdparty/Filemanager/filemanager/",
        filemanager_title:"Quản lý file upload" ,
        external_plugins: { "filemanager" :"/3rdparty/Filemanager/filemanager/plugin.min.js"},
        height: 250
    });
}
function setUpload(){

}

