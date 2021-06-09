$(document).on('click','.popup_selector',function (event) {
    event.preventDefault();
    var updateID = $(this).attr('data-inputid'); // Btn id clicked
    var elfinderUrl = '/file-manager/popup/';

    // trigger the reveal modal with elfinder inside
    var triggerUrl = elfinderUrl + updateID;
    $.colorbox({
        href: triggerUrl,
        fastIframe: true,
        iframe: true,
        width: '70%',
        height: '70%'
    });

});

function pickFile(updateID, multiple = false) {
    var elfinderUrl = '/file-manager/popup/';

    // trigger the reveal modal with elfinder inside
    var triggerUrl = elfinderUrl + updateID;
    if(multiple) triggerUrl = triggerUrl+'?multiple';
    $.colorbox({
        href: triggerUrl,
        fastIframe: true,
        iframe: true,
        width: '70%',
        height: '70%'
    });

}

// function to update the file selected by elfinder
function processSelectedFile(filePath, requestingField) {
    $('#' + requestingField).val('/'+filePath.replace(/\\/g,'/')).trigger('change');
}
function processSelectedMultipleFile(files, requestingField) {
    console.log(files, requestingField);
    // console.log($('#' + requestingField), $('#' + requestingField).data('counter'))
    var n = parseInt( $('#' + requestingField).data('counter'))
    for(i=0; i < files.length; i++){
        // console.log(files[i].path.replace('\\','/').replace('files/', 'media/thumb/'))
        var html = `<div id="gallery-item-${n+i+1}" class="gallery-item">
                                        <img src="/${files[i].path.replace('\\','/')}" class="gallery-item-img" id="gallery-item-img-${n+i+1}"/>
                                        <input class="gallery-item-input" type="hidden" name="gallery[]" value="/${files[i].path.replace('\\','/')}" id="gallery-item-input-${n+i+1}"/>
                                        <span class="gallery-item-close" data-id="#gallery-item-${n+i+1}" id="gallery-item-close-${n+i+1}">x</span>
                                    </div>`
        $('#' + requestingField).append(html)
    }
    $('#' + requestingField).data('counter', n+files.length)
}

function pickGallery(galleryID, multiple = true) {
    var elfinderUrl = '/file-manager/popup/';

    // trigger the reveal modal with elfinder inside
    var triggerUrl = elfinderUrl + galleryID;
    if(multiple) triggerUrl = triggerUrl+'?multiple';
    $.colorbox({
        href: triggerUrl,
        fastIframe: true,
        iframe: true,
        width: '70%',
        height: '70%'
    });

}