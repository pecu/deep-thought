pragma solidity ^0.6.0;
/*
練習4的重點：
1. 理解如何在合約內創立另一個合約，並且call另一個合約的function
2. 理解pure的使用情境(不讀也不寫，單獨對接受到的參數做處理)，跟view做比較。同樣也不會有gas產生。
*/
contract math {
    //透過new Mathematics()的方式創立一個型別為Mathematics(合約)的變數m
    Mathematics m = new Mathematics();

    //透過m.square的方式去call原本寫在Mathematics裡的square函數
    function sqr(int256 num) external view returns (int256) {
        return m.square(num);
    }

    //透過m.multiple的方式去call原本寫在Mathematics裡的square函數
    function mul(int256 num1, int256 num2) external view returns (int256) {
        return m.multiple(num1, num2);
    }
}

contract Mathematics {
    function square(int256 num) external pure returns (int256) {
        return num * num;
    }

    function multiple(int256 first, int256 second)
        external
        pure
        returns (int256)
    {
        return first * second;
    }

}
