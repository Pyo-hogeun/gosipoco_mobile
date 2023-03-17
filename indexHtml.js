const fs = require('fs');
let iconv = require('iconv-lite');
const dir = './html';
let htmlFileList = {};
let htmlTemplate = `<html lang="ko">
<head>
  <meta charset="euc-kr">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HTML 리스트</title>
  <style>
    body, html, ul{
      margin: 0;
      padding: 0;
    }
    a{
      display: inline-block;
      text-decoration: none;
      color: #333333;
    }
    a.link.on{
      color: #000000;
      font-weight: 700;
    }
    a.tag{
      border: 1px solid #999999;
      padding: 5px;
      font-size: 10px;
      color: #999999;
      vertical-align: middle;
      margin-left: 20px;
    }
    h2{
      position: sticky;
      top: 0;
      padding: 10px;
    }
    ul{
      width: 500px;
    }
    li{
      list-style: none;
      border-bottom: 1px solid #d8d8d8;
      padding: 10px 10px 10px 20px;
    }
    li:hover{
      background-color: #f1f1f1;
    }
    iframe{
      position: fixed;
      left: 500px;
      width: calc(100vw - 520px);
      height: 100vh;
      right:10px;
      top: 0;
      bottom: 0;
      background-color: #ffffff;
      box-sizing: border-box;
    }
  </style>
</head>
<body>`;
const category = fs.readdirSync(dir);
console.log(category);

// let categoryKey = htmlFileList.keys(htmlFileList);
htmlTemplate += `<div class="wrap"><ul>`;
category.forEach((item)=>{
  
  htmlTemplate += `<li><a href="./html/${item}" target="viewer" class="link"> ${item}</a><a href="./html/${item}" target="_blank" class="tag">새창열기</a></li>`;
});
htmlTemplate += `</ul></div>`;

htmlTemplate += `<script>
console.log('script');
let links = document.querySelectorAll('a.link');
links.forEach((item, index)=>{
  item.addEventListener('click', function(e){
    let onLinks = document.querySelectorAll('a.link.on');
    onLinks.forEach((item, index)=>{
      item.classList.remove('on');
    })
    e.target.classList.add('on');
  })
})
</script>`

// const css = 
const iframe = '<iframe src="./html/board-type/N_게시글_리스트_타입3-3.html" name="viewer"></iframe>';
htmlTemplate += iframe;

let euckrStr = iconv.encode(htmlTemplate, 'euc-kr');
fs.writeFile('index.html', euckrStr, 'binary', ()=>{
  console.log('성공');
});
// console.log(htmlTemplate);