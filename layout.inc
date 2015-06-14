<?php
// 세션을 시작합니다.
// 이후에 사용 할 로그인 용.
session_start();

// class를 이용한 객체 지향 방식
class Layout
{
	public $title="Team GPS"; // 웹 페이지 제목
	public $link; // CSS 링크 태그
	public $style; // 스타일 적용 
	public $head;
	public $content; // 메인 컨텐츠
	public $side;
	public $board; //게시판 이름 지정
	private $sub; // 서브 메뉴용 변수
	private $login; // 로그인이나 로그아웃을 출력

	// 레이아웃을 출력
	public function LayoutMain()
	{
		echo $this->ThisBoard(); // 현재 게시판의 이름을 확인
		echo "<!DOCTYPE html>\n<html lang='ko'>";
		echo "<head>\n<meta charset='utf-8'/>";
		echo "<title>".$this->title."</title>";
		echo $this->head;
		echo $this->LayoutStyle(); // 스타일을 레이아웃에 추가.
		echo "</head>\n<body>\n<div id='container'>";
		echo  $this->LayoutHeader(); // 헤더 부분을 레이아웃에 추가
		echo	$this->LayoutContent(); // 컨텐츠 부분을 레이아웃에 추가
		echo	$this->LayoutSide(); // 사이드 부분을 레이아웃에 추가
		echo	$this->LayoutFooter(); // 푸터 부분을 레이아웃에 추가
		echo "</div></body>\n</html>";
	}

	// 현재 게시판의 이름을 확인
	public function ThisBoard()
	{
		$this->board = explode('/', $_SERVER['PHP_SELF']);
	}
  
	// 스타일을 추가
	public function LayoutStyle()
	{
		echo "<link rel='stylesheet' type='text/css' href='".$this->link."'/> ";
		echo "<style>".$this->style."</style>";
	}
	
	// 헤더 부분 추가
	public function LayoutHeader()
	{
		$this->LayoutLogin();
		echo "<header>
			<div id='logo'><h1><a href='/'>Team GPS</a></h1></div>
				<div id='navset'>
					<nav id='login'>".$this->login."</nav>
				</div>
			<div class='ad_1'>
			</div>
		</header>";
	}
	public function LayoutMenu($menu, $side) // 배열과 <li> 을 이용해서 메뉴 부분을 호출
	{
		while (list($key, $value) = each($menu))
		{
			$this->ThisMenu($key, $value, $side);
        	}
	}
	
	public function ThisMenu($key, $value ,$side) //받아온 값으로 메뉴를 출력함
	{
		if($side=='1')
		{
			if(strpos($_SERVER['REQUEST_URI'], $value)==false)
			{
				$thismenu = $thismenu."<li><a href='./".$value."'>".$key."</a></li>";
			} else
			{
				$thismenu = $thismenu."<li><b style='border-bottom:4px solid #90bbff;'>".$key."</b></li>";
			}
		} else
		{		
			if(strpos($_SERVER['PHP_SELF'], $value)==false)
			{
				$thismenu = $thismenu."<li><a href='/".$value."'>".$key."</a></li>";
			} else
			{
				$thismenu = $thismenu."<li><b style='border-bottom:4px solid #90bbff;'>".$key."</b></li>";
			}
		}
		echo $thismenu;
	}

	public function LayoutLogin()
	{
		if($_SESSION['user_number']=="")
		{
			if(strpos($_SERVER['PHP_SELF'], "login.php"))
			{
				$this->login="<b style='border-bottom:3px solid #90bbff;'>Login</b>";
			} else
			{
				$this->login="<a href='/login.php?login=0'>Login</a>";
			}
		} else
		{
			$this->login="<a href='/Logout.php'>Logout</a>";
		}
	}

	// 내용을 추가
	public function LayoutContent()
	{
		echo "<section><article>".$this->content."</article>";
	}

	// 사이드바 추가
	public function SideMenu()
	{
		echo $this->side;
	}

	public function LayoutSide()
	{		
		echo "<aside>";
		$this->SideMenu();
		echo "</aside></section>";
	}
	
  public function LayoutFooter()
	{
		echo "<footer>Copyright © Team GPS. All rights reserved.</footer>";
	}
	
	public function AdminSide() {
    $this->side='<table class="nav" style="margin:5 auto; margin-left:10%; width="90%"">
    <caption><h1>관리자 메뉴</h1></caption>
      <tr>
        <td><a href="./admin_month.php">월별 출석 현황</a><p/></td>
      </tr>
      <tr>
        <td><a href="./admin_subject.php">과목별 출석 현황</a><p/></td>
      </tr>
      <tr>
        <td><a href="./lecture_add.php">과목 추가</a><p/></td>
      </tr>
      <tr>
        <td><a href="./lecture_delete.php">과목 삭제</a><p/></td>
      </tr>
      <tr>
        <td><a href="./index.php" target="_top" onclick="logout()">로그 아웃</a></td>
      </tr>
    </table>';
  }
}
?>