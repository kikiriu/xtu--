<?php
include_once "../models/conn.php";

$username = $_GET["username"];
$password = $_GET["password"];
$password2 = $_GET["password2"];
if (strlen($username) > 15 || strlen($username) < 2 || strlen($password) < 2 || strlen($password) > 25) {
    echo "<script>alert('用户名或密码不符合规范！');
location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>";
}
else if ($password != $password2) {
    echo "<script>alert('第二次密码不一致');
    location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>";
}
else useradd($conn, $username, $password);
//插入
function useradd($conn, $username, $password)
{
    // 创建随机的昵称名
    $randomXing = array('欢快的', '沉稳的', '陶醉的', '自信的', '潇洒的', '积极的', '热情的', '深情的', '坚强的', '温柔的', '可爱的', '愉悦的', '正直的', '真诚的', '豁达的', '英勇的', '睿智的', '慷慨的', '亲切的', '机智的', '谦虚的', '和谐的', '温暖的', '平和的', '耐心的', '谨慎的', '独特的', '平静的', '安详的', '灵活的', '冷静的', '务实的', '幽默的', '友善的', '体贴的', '纯真的', '自由的', '淡然的', '感性的', '激情的', '睿智的', '晴朗的', '勤奋的', '包容的', '虚拟的', '微笑的', '宽容的', '自律的', '忧郁的', '明亮的', '沉默的', '奇妙的', '珍惜的', '创新的', '独立的', '向往的', '优雅的', '内向的', '简单的', '深刻的', '宏伟的', '安全的', '勇敢的', '舒适的', '出色的', '谜一样的', '细腻的', '真实的', '睿智的', '宁静的', '朝气蓬勃的', '骄傲的', '卓越的', '执着的', '坚毅的', '勇往直前的', '积极向上的', '充满希望的', '干净的', '迷人的', '难忘的', '陶醉的', '清新的', '朝阳', '和煦的', '魅力四射的', '神秘的', '迷人的', '耀眼的', '温和的', '大胆的', '无畏的', '坚定的', '绚丽的', '平淡的', '狂热的', '踏实的', '贴心的', '高贵的', '光芒四射的', '宽广的', '晶莹的', '负责的', '丰富的', '亲爱的', '快乐的', '智慧的', '轻盈的', '蓬勃的', '柔软的', '动人的', '高效的', '出众的', '耐心的', '明理的', '感性的', '洞察力', '坚韧的', '睿智的', '快乐的', '英俊的', '清爽的', '活泼的', '自由的', '灿烂的', '阳光的', '亲切的', '机智的', '幽默的', '踏实的', '刚毅的', '聪慧的', '勤奋的', '平静的', '豁达的', '平和的', '宽容的', '深刻的', '坚定的', '魅力四射的', '优雅的', '淡定的', '幸福的', '高效的', '自由的', '清爽的', '活泼的', '灿烂的', '亲切的', '机智的', '幽默的', '聪慧的', '勤奋的', '平静的', '豁达的', '宽容的', '真挚的', '坚定的', '优雅的', '淡定的', '幸福的', '自由的', '活泼的', '亲切的', '机智的', '幽默的', '聪慧的', '勤奋的', '豁达的', '坚定的', '优雅的', '幸福的', '自由的', '亲切的', '聪慧的', '坚定的', '优雅的', '活泼的', '幸福的', '亲切的', '勤奋的', '自由的', '机智的', '坚定的', '聪慧的', '幸福的', '亲切的', '活泼的', '自由的', '幸福的', '自由的', '活泼的', '亲切的', '坚定的', '幸福的', '活泼的', '聪慧的', '自由的', '欣喜的', '迷人的', '魅力四射的', '耐心的', '真挚的', '坚定的', '优雅的', '清爽的', '活泼的', '幽默的', '聪慧的', '勤奋的', '豁达的', '宽容的', '自由的', '幸福的', '灿烂的', '平和的', '感性的','欣喜的', '迷人的', '魅力四射的', '耐心的', '真挚的', '坚定的', '优雅的', '清爽的', '活泼的', '幽默的', '聪慧的', '勤奋的', '豁达的', '宽容的', '自由的', '幸福的', '灿烂的', '平和的', '感性的', '勤恳的', '美丽的', '腼腆的', '优美的', '甜美的', '甜蜜的', '整齐的', '动人的', '典雅的', '尊敬的', '舒服的', '妩媚的', '秀丽的', '喜悦的', '甜美的', '彪壮的', '强健的', '大方的', '俊秀的', '聪慧的', '迷人的', '陶醉的', '悦耳的', '动听的', '明亮的', '结实的', '魁梧的', '标致的', '清脆的', '敏感的', '光亮的', '大气的', '老迟到的', '知性的', '冷傲的', '呆萌的', '野性的', '隐形的', '笑点低的', '微笑的', '笨笨的', '难过的', '沉静的', '火星上的', '失眠的', '安静的', '纯情的', '要减肥的', '迷路的', '烂漫的', '哭泣的', '贤惠的', '苗条的', '温婉的', '发嗲的', '会撒娇的', '贪玩的', '执着的', '眯眯眼的', '花痴的', '想人陪的', '眼睛大的', '高贵的', '傲娇的', '心灵美的', '爱撒娇的', '细腻的', '天真的', '怕黑的', '感性的', '飘逸的', '怕孤独的', '忐忑的', '高挑的', '傻傻的', '冷艳的', '爱听歌的', '还单身的', '怕孤单的', '懵懂的');
    $randomMing = array('嚓茶', '凉面', '便当', '毛豆', '花生', '可乐', '灯泡', '哈密瓜', '野狼', '背包', '眼神', '缘分', '雪碧', '人生', '牛排', '蚂蚁', '飞鸟', '灰狼', '斑马', '汉堡', '悟空', '巨人', '绿茶', '自行车', '保温杯', '大碗', '墨镜', '魔镜', '煎饼', '月饼', '月亮', '星星', '芝麻', '啤酒', '玫瑰', '大叔', '小伙', '哈密瓜，数据线', '太阳', '树叶', '芹菜', '黄蜂', '蜜粉', '蜜蜂', '信封', '西装', '外套', '裙子', '大象', '猫咪', '母鸡', '路灯', '蓝天', '白云', '星月', '彩虹', '微笑', '摩托', '板栗', '高山', '大地', '大树', '电灯胆', '砖头', '楼房', '水池', '鸡翅', '蜻蜓', '红牛', '咖啡', '机器猫', '枕头', '大船', '诺言', '钢笔', '刺猬', '天空', '飞机', '大炮', '冬天', '洋葱', '春天', '夏天', '秋天', '冬日', '航空', '毛衣', '豌豆', '黑米', '玉米', '眼睛', '老鼠', '白羊', '帅哥', '美女', '季节', '鲜花', '服饰', '裙子', '白开水', '秀发', '大山', '火车', '汽车', '歌曲', '舞蹈', '老师', '导师', '方盒', '大米', '麦片', '水杯', '水壶', '手套', '鞋子', '自行车', '鼠标', '手机', '电脑', '书本', '奇迹', '身影', '香烟', '夕阳', '台灯', '宝贝', '未来', '皮带', '钥匙', '心锁', '故事', '花瓣', '滑板', '画笔', '画板', '学姐', '店员', '电源', '饼干', '宝马', '过客', '大白', '时光', '石头', '钻石', '河马', '犀牛', '西牛', '绿草', '抽屉', '柜子', '往事', '寒风', '路人', '橘子', '耳机', '鸵鸟', '朋友', '苗条', '铅笔', '钢笔', '硬币', '热狗', '大侠', '御姐', '萝莉', '毛巾', '期待', '盼望', '白昼', '黑夜', '大门', '黑裤', '钢铁侠', '哑铃', '板凳', '枫叶', '荷花', '乌龟', '仙人掌', '衬衫', '大神', '草丛', '早晨', '心情', '茉莉', '流沙', '蜗牛', '战斗机', '冥王星', '猎豹', '棒球', '篮球', '乐曲', '电话', '网络', '世界', '中心', '鱼', '鸡', '狗', '老虎', '鸭子', '雨', '羽毛', '翅膀', '外套', '火', '丝袜', '书包', '钢笔', '冷风', '八宝粥', '烤鸡', '大雁', '音响', '招牌', '胡萝卜', '冰棍', '帽子', '菠萝', '蛋挞', '香水', '泥猴桃', '吐司', '溪流', '黄豆', '樱桃', '小鸽子', '小蝴蝶', '爆米花', '花卷', '小鸭子', '小海豚', '日记本', '小熊猫', '小懒猪', '小懒虫', '荔枝', '镜子', '曲奇', '金针菇', '小松鼠', '小虾米', '酒窝', '紫菜', '金鱼', '柚子', '果汁', '百褶裙', '项链', '帆布鞋', '火龙果', '奇异果', '煎蛋', '唇彩', '小土豆', '高跟鞋', '戒指', '雪糕', '睫毛', '铃铛', '手链', '香氛', '红酒', '月光', '酸奶', '银耳汤', '咖啡豆', '小蜜蜂', '小蚂蚁', '蜡烛', '棉花糖', '向日葵', '水蜜桃', '小蝴蝶', '小刺猬', '小丸子', '指甲油', '康乃馨', '糖豆', '薯片', '口红', '超短裙', '乌冬面', '冰淇淋', '棒棒糖', '长颈鹿', '豆芽', '发箍', '发卡', '发夹', '发带', '铃铛', '小馒头', '小笼包', '小甜瓜', '冬瓜', '香菇', '小兔子', '含羞草', '短靴', '睫毛膏', '小蘑菇', '跳跳糖', '小白菜', '草莓', '柠檬', '月饼', '百合', '纸鹤', '小天鹅', '云朵', '芒果', '面包', '海燕', '小猫咪', '龙猫', '唇膏', '鞋垫', '羊', '黑猫', '白猫', '万宝路', '金毛', '山水', '音响');
    $nickname = $randomXing[rand(0, count($randomXing) - 1)] . $randomMing[rand(0, count($randomMing) - 1)];
    $sql = "INSERT INTO user (username,password,nickname) VALUES (?,?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password,$nickname);
    $stmt->execute();

    echo "<script>alert('注册成功');
    location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>"; //返回上一个页面
}
