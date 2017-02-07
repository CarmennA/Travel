(function() {
    function loadData(data) {
        var el = document.getElementById('test');
        el.textContent = data;
    }

    httpGetAsync("http://localhost:8012/project/Travel/api.php?action=get_all_countries", loadData);
})();