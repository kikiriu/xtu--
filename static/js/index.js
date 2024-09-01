const Index = {                 //一个对象，嵌入两个对象
    //存储数据用的对象
    data: {
        bs: document.querySelector("#bs"),
        inputsea: document.querySelector("#sea"),
        htmlCard: ""
    },

    func: {
        init: function () {
            //初始化社区数据
            //Index.func.getCommunity();
        },
        clickhome: function () {//匿名函数
            console.log("首页导航被点击")
        },
        changesea: function () {
            console.log("已经改变" + Index.data.inputsea.value)
        }
        // getCommunity: function () {
        //     //接受服务器社区数据
        //     fetch('../controls/index.php', {
        //         method: 'GET',
        //         mode: 'cors',//允许发送跨域请求
        //         Credentials: 'include'//证书
        //     })
        //         .then(reponse => {
        //             return reponse.json()
        //         })
        //         .then(data => {
        //             data.forEach(v => {
        //                 Index.data.htmlCard += `
        //             <div class="col-4" id="ccard">
        //                 <div class="card" style="width: 18rem;">
        //                     <img src="../static/assets/images/zygeko.jpg" class="card-img-top" alt="...">
        //                     <div class="card-body">
        //                         <h5 class="card-title">Card title</h5>
        //                         <p class="card-text">${v.username}</p>
        //                         <p class="card-text">${v.brief}</p>
        //                     </div>
        //                 </div>
        //             </div>`//不是单引号 波浪线下面那个
        //             });

        //             const ccard = document.querySelector("#ccard")
        //             ccard.innerHTML += Index.data.htmlCard//替换  
        //             //console.log(htmlCard);
        //         });
        // }
    }
}

// let navv=document.querySelector("#navv")
// sea.onmouseover=function(){
//     navv.innerHTML="<h1>已经改变</h1>"
// }

//无需封装 页面自动加载,也可放入init里
// window.onload = function () {//加载完成时弹出
//     console.log("页面已经加载完成")
// }

document.onreadystatechange = function () {
    let loading = document.querySelector("#mask")
    if (document.readyState == 'complete') {
        setTimeout(function () {
            console.log("加载完成")
            loading.style.display = "none"
        }, 0);                 //延迟3s之后执行  计时器2
    }
    else {
        loading.style.display = "block"//修改CSS样式
    }
}



//已经封装
// let bs=document.querySelector("#bs")
// bs.onclick=function(){//匿名函数
//     console.log("首页导航被点击")
// }
//在JS中找到这个元素设置事件
//或者在原文件设置事件 也要用函数，要有函数名

// let sea=document.querySelector("#sea")//这个取名还是要长一点否则可能出错
// sea.onchange=function(){//匿名函数
//     console.log("已经改变"+sea.value)
// }
// let sea = document.querySelector("#sea")
// sea.onkeydown = function () {//匿名函数
//     console.log("已经改变" + sea.value)
// }
//与onkeyup 事件相关的事件发生次序：
// 1 onkeydown 2 onkeypress 3 onkeyup