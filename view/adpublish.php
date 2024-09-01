<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>管理员页面</title>
    <link rel="stylesheet" href="../static/pkg/bootstrap4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../static/css/adindex.css">
    <script src="../static/pkg/jquery3.7.0/jquery-3.7.0.min.js"></script>
    <style>
        /* 使得按钮居中 */
        .custom-button-container {
            display: flex;
            align-items: center;
        }

        .disabled-link {
            color: #888;
            /* 设置链接颜色为灰色 */
            pointer-events: none;
            /* 禁用点击事件 */
            cursor: not-allowed;
            /* 显示禁用状态的鼠标光标 */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="../static/pkg/bootstrap4.6.1/js/bootstrap.min.js"></script>
    <script src="../static/pkg/popper/popper.min.js"></script>
    <script src="../static/pkg/js-cookie/js.cookie.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // 获取当前页面的URL
            var currentUrl = window.location.href;

            // 获取导航链接的<a>元素
            var userLink = document.querySelector("a[href='./adIndex.php']");
            var postLink = document.querySelector("a[href='./adpublish.php']");

            // 检测是否为用户信息页，并添加或删除 "disabled-link" 类
            if (currentUrl.includes("adIndex.php")) {
                userLink.classList.add("disabled-link");
            } else {
                userLink.classList.remove("disabled-link");
            }

            // 检测是否为帖子信息页，并添加或删除 "disabled-link" 类
            if (currentUrl.includes("adpublish.php")) {
                postLink.classList.add("disabled-link");
            } else {
                postLink.classList.remove("disabled-link");
            }
        });
    </script>
</head>

<body>
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link active disabled" href="#">
                <?php
                include_once "../models/conn.php";
                if (isset($_SESSION['account'])) {
                    echo "当前操作员：" . $_SESSION['account'];
                } else {
                    echo "<script>location.href='./adlogin.html'</script>";
                }


                ?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./adlogout.php">退出</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./adIndex.php">用户信息页</a>
        </li>
        <li class="nav-item mr-auto">
            <a class="nav-link" href="./adpublish.php">帖子信息页</a>
        </li>

    </ul>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">标题</th>
                <th scope="col">分类</th>
                <th scope="col">内容</th>
                <th scope="col">发帖人</th>
                <th scope="col">发帖时间</th>
                <th scope="col">点击量</th>
                <th scope="col">状态</th>
                <th scope="col">操作</th>
            </tr>
        </thead>
        <tbody id="userList">
            <!-- <tr>
			<th scope="row">1</th>
			<td>Mark</td>
			<td>Otto</td>
			<td>@mdo</td>
		  </tr> -->

        </tbody>
    </table>

    <div class="container"> <!-- 布局  留白 80%填充 --> <!-- container-fluid 100%填充 -->
        <script src="../static/pkg/popper/popper.min.js"></script>
        <script>
            fetch('/controls/getpostList.php', {
                    method: 'GET',
                    mode: 'cors', //允许发送跨域请求
                    Credentials: 'include' //证书
                })
                .then(reponse => {
                    return reponse.json()
                })
                .then(data => {
                    let userList = document.querySelector("#userList");
                    data.forEach(v => {
                        //  pubtime=date("Y-m-d H:i:s",$v[4] );  PHP的语法
                        let content = v[2].length > 10 ? `${v[2].substring(0, 10)}...` : v[2]; //限制显示的长度
                        let pubDate = new Date(v[4] * 1000);
                        let formattedDate = `${pubDate.getFullYear()}-${(pubDate.getMonth() + 1).toString().padStart(2, '0')}-${pubDate.getDate().toString().padStart(2, '0')} ${pubDate.getHours().toString().padStart(2, '0')}:${pubDate.getMinutes().toString().padStart(2, '0')}:${pubDate.getSeconds().toString().padStart(2, '0')}`;
                        let buttonClass = v[6] == 1 ? "btn btn-danger" : "btn btn-primary";
                        if (v[8] == "生效中")
                            userList.innerHTML += `
                            <tr>
                                <th scope="row">${v[1]}</th>
                                <td>${v[6]}</td>
                                <td>${content}</td>
                                <td>${v[3]}</td>
                                <td>${formattedDate}</td>
                                <td>${v[5]}</td>
                                <td style="color: green;">${v[8]}</td>
                                <td><button id="${v[0]}" type="button" class="${buttonClass} btn-details" data-toggle="modal" data-target="#ModalPublish"></button></td>
                            </tr>
                            `
                        else
                            userList.innerHTML += `
                            <tr>
                                <th scope="row">${v[1]}</th>
                                <td>${v[6]}</td>
                                <td>${content}</td>
                                <td>${v[3]}</td>
                                <td>${formattedDate}</td>
                                <td>${v[5]}</td>
                                <td>${v[8]}</td>
                                <td><button id="${v[0]}" type="button" class="${buttonClass} btn-details" data-toggle="modal" data-target="#ModalPublish"></button></td>
                            </tr>
                            `
                    }); // 表的主键当作button的id

                    let buttons = document.querySelectorAll(".btn-details");
                    //必须要加上btn-details
                    buttons.forEach(button => {
                        button.addEventListener("click", function() {
                            let pubIdInput = document.querySelector("#pub_id");
                            pubIdInput.value = this.id;
                            console.log(this.id)
                            console.log(pubIdInput);
                        });
                    });
                });
        </script>
    </div>
    <script>

    </script>
    <!-- 操作帖子 -->
    <div class="modal fade" id="ModalPublish" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="get" action="/controls/post_deal.php">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">操作帖子</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="module_id" class="form-label">选择操作：</label>
                            <select name="module_id" class="form-select">
                                <option value="delete">删除帖子</option>
                                <option value="view">查看帖子</option>
                                <option value="over">完结帖子</option>
                                <option value="unover">取消完结</option>
                                <option value="sticky">设为置顶</option>
                                <option value="unsticky">取消置顶</option>
                            </select>
                            <input type="hidden" name="pub_id" id="pub_id" value="">
                        </div>
                    </div><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        <input type="submit" class="btn btn-primary" name="submit" value="执行">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>

    </script>
</body>

</html>