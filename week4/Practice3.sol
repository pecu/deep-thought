pragma solidity ^0.6.0;
/*
練習3的重點：
1. constructor會在合約創立時去執行，並且要宣告為payable才能再創力合約的同時轉錢給合約地址
2. fallback會在你call了一個不存在的function識別碼而觸發。
3. selfdestruct會把當前合約所有的餘額，轉給後面括弧所接收的地址。
4. receive會在你單純轉錢給合約，沒有call任何function識別碼的時候觸發。
*/
contract Practice3 {
  //宣告一個型別為address的變數並且是owner的，這樣這個address才能做轉帳的動作
  address payable public owner;

  //合約在創立時會執行constructor函數，並把owner設定為創立合約的帳戶地址。
  constructor () public payable{
      owner = msg.sender;
  }

  //如果有人call了不存在的function識別碼就會觸發fallback，並且去檢查觸發的地址是否為owner
  //是的話就往下selfdestruct，不是的話就拋出error message
  fallback () external {
      require(owner == msg.sender, "Permission denied.");
      selfdestruct(owner);
  }
  
  //如果有人單純轉錢給合約而觸發receive，就轉錢給特定地址(這邊我是拿remix jacascript VM的第五個account address來當範例)
  receive () external payable {
      0xdD870fA1b7C4700F2BD7f44238821C26f7392148.transfer(msg.value);
  }

}