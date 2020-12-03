/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function(config) {
    config.toolbar = [
        {
            name: "document",
            items: [
                "Source",
                "-",
                "Save",
                "NewPage",
                "ExportPdf",
                "Preview",
                "Print",
                "-",
                "Templates"
            ]
        },  
        {
            name: "basicstyles",
            items: [
                "Bold",
                "Italic",
                "Underline",
                "Strike",
                "Superscript",  
            ]
        },
        {
            name: "paragraph",
            items: [
                "NumberedList",
                "BulletedList",
            ]
        },
     
        {
            name: "insert",
            items: [
                "Image",        
                "Table",
            ]
        },
        { name: "styles", items: ["Styles", "Format", "Font", "FontSize"] },
        { name: "colors", items: ["TextColor", "BGColor"] },
        { name: "tools", items: ["Maximize", "ShowBlocks"] },
    ];
};
