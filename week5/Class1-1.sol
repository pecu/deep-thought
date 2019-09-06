pragma solidity ^0.5.0;

contract buytickets{
    address payable buyer;
    uint public   tickets;
    uint constant price = 1 ether;
    
    mapping (address => uint) public ticketsbought;
    
    constructor() public {
        tickets = 100;
        buyer = msg.sender;
    }
    
    function BuyTickets(uint amount) public payable{
        if(amount>tickets || msg.value != (amount*price)){
            revert();
        }
        ticketsbought[msg.sender] += amount;
        tickets -= amount;
        
        if(tickets == 0){
        selfdestruct(buyer);
        }
    }
    
    function () external payable{
        BuyTickets(1);
    }
    
}