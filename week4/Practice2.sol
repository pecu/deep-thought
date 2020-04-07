pragma solidity ^0.6.0;
/*
練習2的重點：
1. 理解array的操作
2. 理解什麼view的概念(只讀取鏈上資料，不寫入資料的情況)，並也不會有手續費產生
3. 理解如果delete array的某個index之後，array的總長度不會改變，但是該index的值會被清空。
*/
contract Practice2 {
    //宣告一個型態為address的array
    address[] public students;

    //把接收到的參數studentAddress，利用push的方式新增近所宣告的變數students裡
    function addStudent(address studentAddress) external {
        students.push(studentAddress);
    }

    //對於某個studentIndex的值做刪除，並且去呼叫getStudentsLen了解array長度不會變
    function deleteStudent(uint256 studentIndex) external {
        delete students[studentIndex];
    }

    //回傳array的長度(讀取資料，無寫入，所以用view)
    function getStudentsLen() external view returns (uint256) {
        return students.length;
    }

    //刪除整個array
    function deleteArray() public {
        delete students;
    }

}
