pragma solidity ^0.5.0;

contract math{
    
    Mathematics m = new Mathematics();
    
    function sqr() public returns(int){
        return m.square(10);
    }
    
    function mul() public returns(int){
        return m.multiple(9,8);
    }
}

contract Mathematics{
    
    function square(int num) public returns (int){
        return num*num;
    }
    
    function multiple(int first, int second) public returns(int){
        return first*second;
    }
    
}