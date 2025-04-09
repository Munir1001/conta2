(function($) {
	
	var direction =  getUrlParams('dir');
	if(direction != 'rtl')
	{direction = 'ltr'; }

	var dezSettingsOptions = {
		typography: "poppins",
		version: "light",
		layout: "Vertical",
		headerBg: "color_1",
		navheaderBg: "color_1",
		sidebarBg: "color_1",
		sidebarStyle: "full",
		sidebarPosition: "fixed",
		headerPosition: "fixed",
		containerLayout: "full",
		direction: direction
	};
		
	new dezSettings(dezSettingsOptions); 

	jQuery(window).on('resize',function(){
		new dezSettings(dezSettingsOptions); 
	});

})(jQuery);

document.addEventListener("scroll", function () {
    let openDropdowns = document.querySelectorAll(".dropdown.show .dropdown-menu");
    openDropdowns.forEach(function (dropdown) {
        let parent = dropdown.closest(".dropdown");
        if (parent) {
            let toggleButton = parent.querySelector(".dropdown-toggle");
            if (toggleButton) {
                toggleButton.click(); // Cierra el dropdown
            }
        }
    });
});

  