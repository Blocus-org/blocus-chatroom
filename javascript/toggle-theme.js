function setTheme(themeName) {
    localStorage.setItem('theme', themeName);
    document.documentElement.className = themeName;
}

function toggleTheme() {
   if (localStorage.getItem('theme') === 'dark'){
       setTheme('root');
   } else {
       setTheme('dark');
   }
}

(function () {
   if (localStorage.getItem('theme') === 'dark') {
       setTheme('dark');
   } else {
       setTheme('root');
   }
})();