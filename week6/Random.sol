pragma solidity ^0.6.0;

library SafeMath {
    function add(uint a, uint b) internal pure returns (uint c) {
        c = a + b;
        require(c >= a);
    }
    function sub(uint a, uint b) internal pure returns (uint c) {
        require(b <= a);
        c = a - b;
    }
    function mul(uint a, uint b) internal pure returns (uint c) {
        c = a * b;
        require(a == 0 || c / a == b);
    }
    function div(uint a, uint b) internal pure returns (uint c) {
        require(b > 0);
        c = a / b;
    }
}

contract TallRichHandsome {
    using SafeMath for uint;
    
    function random() public view returns(uint256) {
        bytes32 result = keccak256(abi.encodePacked(block.timestamp, blockhash(block.number), msg.sender));
        return uint256(result);
    }
    
    function checkTallRichHandsome() public view returns (bool){
        uint256 randomNum = random();
        uint8 richLevel = uint8(randomNum % 10);
        uint8 handsomeLevel = uint8(randomNum.div(100) % 10);
        uint8 hightLevel = 165 + uint8(randomNum.div(10000) % 20);
        require(richLevel >= 8 && handsomeLevel >= 5 && hightLevel >=15, "Not perfect");
        return true;
    }
    
    
}


