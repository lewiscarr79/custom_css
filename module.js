M.block_custom_css = {
    init: function(customCss) {
        var style = document.createElement('style');
        style.textContent = customCss;
        document.head.appendChild(style);
    }
};