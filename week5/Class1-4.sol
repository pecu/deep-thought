pragma solidity ^0.5.0;

contract regulation{
    function loan() public returns (bool);
    function checkValue(uint amount) public returns(bool);
}

contract bank is regulation{
    uint private value;
    
    constructor (uint amount) public{
        value = amount;
    }
    
    function deposit (uint amount) public{
        value += amount;
    }
    
    function withdraw (uint amount) public{
        if(checkValue(amount)){
            value -= amount;
        }
    }
    
    function balance () public view returns(uint) {
        return value;
    }
    
    function checkValue(uint amount) public returns (bool){
        return value >= amount;
    }
    
    function loan() public returns (bool){
        return true;
    }
}

contract MyFirstContract is bank(1000){
    
    string myname;
    uint myage;
    
    function setMyName(string memory newname) public{
        myname = newname;
    }
    
    function getMyName() public view returns(string memory){
        return myname;
    }
    
    function setMyAge(uint newage) public {
        myage = newage;
    }
    
    function getMyAge() public view returns(uint){
        return myage;
    }
}