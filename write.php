<!DOCTYPE>
<html>
<head>
        <meta charset = 'utf-8'>
</head>
<style>
        table.table2{
                border-collapse: separate;
                border-spacing: 1px;
                text-align: left;
                line-height: 1.5;
                border-top: 1px solid #ccc;
                margin : 20px 10px;
        }
        table.table2 tr {
                 width: 50px;
                 padding: 10px;
                font-weight: bold;
                vertical-align: top;
                border-bottom: 1px solid #ccc;
        }
        table.table2 td {
                 width: 100px;
                 padding: 10px;
                 vertical-align: top;
                 border-bottom: 1px solid #ccc;
        }
 
</style>
<body>

    <header class="header">
        <!--헤더 이너 : 로고, 검색창, 로그인-->
        <div class="inner">
            <!--이너 1) 로고-->
            <div class="logo">
                <a href="main3.html">
                    <img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/logo.png?raw=true"/>
                </a>
            </div>
            <!--이너2) 로그인-->
            <div class="topbar">
                <div class="topbar_utility">
                    <div class="nav"></div>

                </div>

            </div>

            <!--이너3) 메뉴바-->
            <div class="gnb" style="overflow: hidden;">
                <ul >
                    <li class="gnb_list">
                        <a href="review.html">
                            <span>Review</span>
                        </a>
                    </li>
                    <li class="gnb_list">
                        <a href="ranking.html">
                            <span>Ranking</span>
                        </a>
                        
                    </li>
                    <li class="gnb_list">
                        <a href="review.html">
                            <span>로그인</span>
                        </a>
                    </li>
                    <li class="gnb_list">
                        <a href="review.html">
                            <span>회원가입</span>
                        </a>
                    </li>

                </ul>
            </div>
            <!--//메뉴바-->

        
            <!--이너4) 검색창-->
            <div class="main_search">
                <select name="searchtype"  class="searchType">
                    <option value="제목">제목</option>
                    <option value="배우">배우</option>
                    <option value="장르">장르</option>
                    <option value="닉네임">닉네임</option>
                </select> 
                <input name="searchterm" class="searchTerm" type="text" size="100%" placeholder="검색어를 입력해주세요">
                <button type="submit" class="searchButton"><img src="images/search.png"></button>
            </div>
        </div>
        <!--헤더 이너-->    
    </header>
    <!--//헤더--> 

    
        <form method = "get" action = "write_action.php">
        <table  style="padding-top:50px" align = center width=700 border=0 cellpadding=2 >
                <tr>
                <td height=20 align= center bgcolor=#ccc><font color=white> 글쓰기</font></td>
                </tr>
                <tr>
                <td bgcolor=white>
                <table class = "table2">
                        <tr>
                        <td>작성자</td>
                        <td><input type = text name = name size=20> </td>
                        </tr>
 
                        <tr>
                        <td>제목</td>
                        <td><input type = text name = title size=60></td>
                        </tr>
 
                        <tr>
                        <td>내용</td>
                        <td><textarea name = content cols=85 rows=15></textarea></td>
                        </tr>
 
                        <tr>
                        <td>비밀번호</td>
                        <td><input type = password name = pw size=10 maxlength=10></td>
                        </tr>
                        </table>
 
                        <center>
                        <input type = "submit" value="작성">
                        </center>
                </td>
                </tr>
        </table>
        </form>
</body>
</html>

