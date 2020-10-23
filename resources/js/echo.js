Echo
    .private('post.updated')
    .listen('PostUpdated', data => {
        const message = 'Изменена статья: ' + data.title + '\n ссылка: ' + data.link + '\n поля: ' + data.fields;
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
        console.log(reportElement)
        Echo
            .channel('report')
            .listen('ReportSended', (e) => {
                reportElement.insertAdjacentHTML('beforeend', reportTable(e.counters));
            });
    }
}
