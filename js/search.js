var AutocompleteSearch = (function() {

    var countries = [];
    var selectedCode = '';

    function loadData(data) {
        countries = JSON.parse(data);
    }

    function showDropdown() {
        document.getElementById("myDropdown").classList.add("show");
    }

    function hideDropdown() {
        document.getElementById("myDropdown").classList.remove("show");
    }

    function updateList(text) {
        if (text === undefined || text === null || text === '') {
            hideDropdown();
            return;
        }

        var filtered = countries.filter(function(item) { return item.name.toLowerCase().includes(text.toLowerCase()); });
        var dropdown = document.getElementById("myDropdown");
        dropdown.innerHTML = "";

        if (filtered.length === 0) {
            var spanTag = document.createElement('span');
            spanTag.innerHTML = "No results";
            dropdown.appendChild(spanTag);
        } else {
            filtered.forEach(function(element) {
                var spanTag = document.createElement('span');
                spanTag.setAttribute('onclick', "AutocompleteSearch.selectCountry('" + element.name + "', '" + element.code + "');");
                spanTag.setAttribute('style', "cursor: pointer;");
                spanTag.innerHTML = element.name;
                dropdown.appendChild(spanTag);
            }, this);
        }

        showDropdown();
    }

    function selectCountry(country, code) {
        selectedCode = code;
        var searchField = document.getElementById("searchField");
        searchField.value = country;
    }

    function search() {
        location.href = "details.php?country=" + selectedCode;
    }

    return {
        loadData: loadData,
        showDropdown: showDropdown,
        hideDropdown: hideDropdown,
        updateList: updateList,
        selectCountry: selectCountry,
        search: search
    }
}());

(function() {

    //Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        var dropdown = document.getElementById("myDropdown")
        if (dropdown.classList.contains('show')) {
            dropdown.classList.remove('show');
        }
    }

    httpGetAsync("api.php?action=get_all_countries", AutocompleteSearch.loadData);
})();
