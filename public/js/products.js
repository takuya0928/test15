$(function () {
    const $tableWrapper = $('#product-table');
    const searchUrl = $tableWrapper.data('search-url');
    const deleteBaseUrl = $tableWrapper.data('delete-base-url');

    let sortColumn = "id";
    let sortDirection = "desc";

    // 検索ボタン押下時
    $("#searchBtn").on("click", function () {
        fetchProducts();
    });

    // ソート
    $(document).on("click", ".sortable", function () {
        const column = $(this).data("column");
        sortDirection =
            (sortColumn === column && sortDirection === "asc") ? "desc" : "asc";
        sortColumn = column;
        fetchProducts();
    });

    // 削除ボタン押下時（Ajaxで非同期削除）
    $(document).on("click", ".delete-btn", function () {
        if (!confirm("本当に削除しますか？")) return;

        const id = $(this).data("id");
        const url = `${deleteBaseUrl}/${id}`;

        $.ajax({
            url: url,
            type: "DELETE",
            data: { _token: $('meta[name="csrf-token"]').attr("content") },
            success: function (res) {
                if (res.success) {
                    $(`#product-${id}`).fadeOut(500, function () {
                        $(this).remove();
                    });
                } else {
                    alert(res.message || "削除に失敗しました。");
                }
            },
            error: function (xhr) {
                alert("サーバーエラーが発生しました。");
            },
        });
    });

    // 検索・ソート共通処理
    function fetchProducts() {
        $.ajax({
            url: "/products/search",
            type: "GET",
            data: {
                keyword: $("#keyword").val(),
                price_min: $("#price_min").val(),
                price_max: $("#price_max").val(),
                stock_min: $("#stock_min").val(),
                stock_max: $("#stock_max").val(),
                sort: sortColumn,
                direction: sortDirection,
            },
            beforeSend: function () {
                // ローディング表示
                $("#product-table").css("opacity", "0.5");
            },
            success: function (html) {
                $("#product-table").html(html);
            },
            complete: function () {
                $("#product-table").css("opacity", "1");
            },
            error: function () {
                alert("データの取得に失敗しました。");
            },
        });
    }
});
