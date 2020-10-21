Echo
    .private('blog_na_laravel_database_post.updated')
    .listen('PostUpdated', data => {
        console.log(data);
        const message = 'Изменена статья: ' + data.title + '\n ссылка: ' + data.link + '\n поля: ' . data.fields;
        alert(message);
    });

window.onload = function() {

    const reportElement = document.querySelector('#report');

    const reportTable = (counters) => {
        let result = `<table class="table">`;
        for (field in counters) {
            result += `<tr>
                <td>${field}</td>
                <td>${counters[field]}</td>
            </tr>`;
        }
        return result + '</table>';
    }

    if (reportElement) {
        Echo
            .channel('blog_na_laravel_database_report')
            .listen('ReportSended', (e) => {
                reportElement.insertAdjacentHTML('beforeend', reportTable(e.counters));
            });
    }
}
