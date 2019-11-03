pragma solidity ^0.5.0;

contract MySecondContract{
    string myname;
    uint myage;
    
    string subject;
    uint score;
    
    event myEvent(string subject_event,uint score_event);
    
    function setMyName (string memory newname) public {
        myname = newname;
    }
    
    function getMyName() public returns(string memory) {
        return myname;
    }
    
    function setMyAge(uint newage) public{
        myage = newage;
    }
    
    function getMyAge() public returns(uint){
        return myage;
    }
    
    function subjectAndscore(string memory _subject,uint _score) public {
        subject = _subject;
        score = _score;
        emit myEvent(subject,score);
    }
}