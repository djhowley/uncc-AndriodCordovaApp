// Initialize your app
var myApp = new Framework7();

// Export selectors engine
var $$ = Dom7;

// Add view
var mainView = myApp.addView('.view-main', {
    // Because we use fixed-through navbar we can enable dynamic navbar
    dynamicNavbar: true
});

// Callbacks to run specific code for specific pages, for example for About page:
myApp.onPageInit('about', function (page) {
    // run createContentPage func after link was clicked
    $$('.create-page').on('click', function () {
        createContentPage();
    });
});

function createContact(){	    
	var name = document.getElementById("name").value;
	var mobile = document.getElementById("mobile").value;
	var work = document.getElementById("work").value;
	var home = document.getElementById("home").value;
	var email = document.getElementById("email").value;
	var url = document.getElementById("url").value;
	var birthdate = document.getElementById("birthdate").value;
	    
	
	//alert(name+mobile+work+home+email+url+birthdate);
	
	var myContact = navigator.contacts.create({"displayName": name, "phoneNumbers": [{"type":"mobile","value":mobile},{"type":"home","value":home},{"type":"work","value":work}],"emails": [{"type":"home","value":email}], "urls": [{"type":"other","value":url}],"birthday": new Date(birthdate)});
	myContact.save(onSuccess,onError);
}

function onSuccess(contact) {
    alert("Save Success");
};

function onError(contactError) {
    alert("Error = " + contactError.code);
};

// Generate dynamic page
var dynamicPageIndex = 0;
function createContentPage() {
	mainView.router.loadContent(
        '<!-- Top Navbar-->' +
        '<div class="navbar">' +
        '  <div class="navbar-inner">' +
        '    <div class="left"><a href="#" class="back link"><i class="icon icon-back"></i><span>Back</span></a></div>' +
        '    <div class="center sliding">Dynamic Page ' + (++dynamicPageIndex) + '</div>' +
        '  </div>' +
        '</div>' +
        '<div class="pages">' +
        '  <!-- Page, data-page contains page name-->' +
        '  <div data-page="dynamic-pages" class="page">' +
        '    <!-- Scrollable page content-->' +
        '    <div class="page-content">' +
        '      <div class="content-block">' +
        '        <div class="content-block-inner">' +
        '          <p>Here is a dynamic page created on ' + new Date() + ' !</p>' +
        '          <p>Go <a href="#" class="back">back</a> or go to <a href="services.html">Services</a>.</p>' +
        '        </div>' +
        '      </div>' +
        '    </div>' +
        '  </div>' +
        '</div>'
    );
	return;
}