pragma solidity ^0.6.0;
/*
練習1的重點：
1. publicFun與externalFun在做的是理解public與external在處理陣列(string在solidity裡就相當於是一個bytes array)
參數時，一個是用memory，一個是用calldata。這在實際去call這兩個function的時候gas會有差距。
2. callPublicFun與callExternalFun在做的是理解如何在內部合約call一個宣告為external的函數(運用this)
並且去觀察gas的差異。
3. 理解mapping的操作。
四個function實際執行的gas花費應為：externalFun < publicFun < callPublicFun < callExternalFun。
*/
contract Practice1 {
    //創立一個mapping，他的功能是把收到的字串映射到地址
    mapping(string => address) public students;

    //宣告一個public的函數，做的事情為把接收到的studentId透過創立的mapping變數映射到studentAddress
    function publicFun(string memory studentId, address studentAddress) public {
        students[studentId] = studentAddress;
    }

    //宣告一個external的函數，做的事情為把接收到的studentId透過創立的mapping變數映射到studentAddress
    function externalFun(string calldata studentId, address studentAddress)
        external
    {
        students[studentId] = studentAddress;
    }

    //call publicFun函數
    function callPublicFun(string calldata studentId, address studentAddress)
        external
    {
        publicFun(studentId, studentAddress);
    }

    //call externalFun函數
    function callExternalFun(string calldata studentId, address studentAddress)
        external
    {
        this.externalFun(studentId, studentAddress);
    }

}
