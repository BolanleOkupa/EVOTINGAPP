(() => {
    document.addEventListener("DOMContentLoaded", () => {
        //enable search
         var e = document.getElementById('searchForm');
          e.style.display = 'block';

            document.getElementById('searchBtn').addEventListener("click", () => {
            let params = (new URL(document.location)).searchParams;
            let category = params.get("category");
            var url = '?category='+category+'&searchLocation='+document.getElementById('searchParam').value;
            alert(url);
            location.href = url;
          })
    });
})();