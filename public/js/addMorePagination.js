function addMorePagination(
    itemsId,
    addMorebtnId,
    eachPage,
    lastPage,
    paginationPath
) {
    const categories = $(itemsId);
    const addMore = $(addMorebtnId);
    var page = 2;
    var index = eachPage;

    //if there arent any items
    if (page > lastPage) {
        addMore.hide();
        return false;
    }

    addMore.click(function () {
        var path = paginationPath + `?page=${page}`;

        addMore.text("درحال لود...");

        addMoreSendAjax(path, index).then((response) => {
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

async function addMoreSendAjax(path, index) {
    let response = await $.ajax({
        type: "get",
        url: path,
    });

    const categoriesResponse = $(response)
        .find("#categories")
        .find("tr")
        .toArray();

    categoriesResponse.forEach((category) => {
        index++;
        $(category).find("#id").html(index);
    });

    return categoriesResponse;
}
