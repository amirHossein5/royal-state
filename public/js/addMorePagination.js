function addMorePagination(
    itemsId,
    itemId,
    addMorebtnId,
    indexId,
    eachPage,
    lastPage,
    paginationPath
) {
    const categories = $(itemsId);
    const addMore = $(addMorebtnId);
    var page = 2;
    var index = eachPage;

    // if there arent few categories
    if (page > lastPage) {
        addMore.hide();
        return false;
    }

    addMore.click(function () {
        var path = paginationPath + `?page=${page}`;

        addMore.text("درحال لود...");

        addMoreSendAjax(path, index, itemId, indexId).then((response) => {
            categories.append(response);
            index += response.length;
            page += 1;
            addMore.text("بیشتر");

            if (page > lastPage) {
                addMore.hide();
            }
        });
    });
}

async function addMoreSendAjax(path, index, itemId, indexId) {
    let response = await $.ajax({
        type: "get",
        url: path,
    });

    const itemsResponse = $(response).find(itemId).toArray();

    itemsResponse.forEach((item) => {
        index++;
        $(item).find(indexId).html(index);
    });

    return itemsResponse;
}
