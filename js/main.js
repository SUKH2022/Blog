 // JavaScript for responsive navbar
 const headerItems = document.querySelector('.header_items');
 const openheaderBtn = document.querySelector('#open_header_btn');
 const closeheaderBtn = document.querySelector('#close_header_btn');

 // open header
 const openheader = () => {
     headerItems.style.display = 'flex';
     openheaderBtn.style.display = 'none';
     closeheaderBtn.style.display = 'inline-block';
 }

 // close header
 const closeheader = () => {
     headerItems.style.display = 'none';
     openheaderBtn.style.display = 'inline-block';
     closeheaderBtn.style.display = 'none';
 }

 openheaderBtn.addEventListener('click', openheader);
 closeheaderBtn.addEventListener('click', closeheader);

 // manage category
 const sidebar = document.querySelector('aside');
 const showSidebarbtn = document.querySelector('#show_sidebar_btn');
 const hideSidebarbtn = document.querySelector('#hide_sidebar_btn');

 // show side bar on mobile applications or small devices
 const showSidebar = () => {
     sidebar.style.left = '0';
     showSidebarbtn.style.display = 'none';
     hideSidebarbtn.style.display = 'inline-block';
 }

 // hideSidebar
 const hideSidebar = () => {
     sidebar.style.left = '-100%';
     showSidebarbtn.style.display = 'inline-block';
     hideSidebarbtn.style.display = 'none';
 }

 showSidebarbtn.addEventListener('click', showSidebar);
 hideSidebarbtn.addEventListener('click', hideSidebar);