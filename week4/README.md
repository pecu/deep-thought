# HW1詳細說明

## 變數宣告
```
mapping (字串 => 地址) students; //學號映射到地址
mapping (地址 => 金額) balances; //地址映射到存款金額
address payable owner; //銀行的擁有者，會在constructor做設定
```
## 函數宣告

```
//可以讓使用者call這個函數把錢存進合約地址，並且在balances中紀錄使用者的帳戶金額
function deposit()

//可以讓使用者從合約提錢，這邊需要去確認合約裡的餘額 >= 想提的金額
function withdraw(金額)

//可以讓使用者從合約轉帳給某個地址，這邊需要去確認合約裡的餘額 >= 想轉的金額
//實現的是銀行內部轉帳，也就是說如果轉帳成功balances的目標地址會增加轉帳金額
function transfer(轉帳金額, 目標地址)

//從balances回傳使用者的銀行帳戶餘額
function getBalance()

//回傳銀行合約的所有餘額，設定為只有owner才能呼叫成功
function getBankBalance()

//透過students把學號映射到使用者的地址
function enroll(學號)

//當觸發fallback時，檢查觸發者是否為owner，是則自殺合約，把合約剩餘的錢轉給owner
fallback()

//設定owner為創立合約的人
constructor()

//在所有需要判別條件的地方都要放上 error message
//所有的function名稱與參數均不要更動，可以自行設定函數內容、可見度及view、pure
//以達成函數的目的。
```
## 加分題
自由設計其他功能，可自行添加變數與函數。

## 其他幫助資訊
* [討論區連結](https://tlk.io/scu-blockchain)--可以提問或討論任何關於課程相關的地方，請多加利用
* [官方文檔連結](https://solidity.readthedocs.io/en/v0.6.0/contracts.html)
* [Google連結](https://google.com)
