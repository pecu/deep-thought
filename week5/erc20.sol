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
 
 

interface ERC20Interface {
    function totalSupply() external view returns (uint);
    function balanceOf(address tokenOwner) external view returns (uint balance);
    function allowance(address tokenOwner, address spender) external view returns (uint remaining);
    function transfer(address to, uint tokens) external returns (bool success);
    function approve(address spender, uint tokens) external returns (bool success);
    function transferFrom(address from, address to, uint tokens) external returns (bool success);
 
    event Transfer(address indexed from, address indexed to, uint tokens);
    event Approval(address indexed tokenOwner, address indexed spender, uint tokens);
}

abstract contract ApproveAndCallFallBack {
    function receiveApproval(address sender, uint256 tokens, address token, bytes memory data) public virtual;
}
 
contract Owned {
    address public owner;
    address public newOwner;
 
    event OwnershipTransferred(address indexed _from, address indexed _to);
 
    constructor() public {
        owner = msg.sender;
    }
 
    modifier onlyOwner {
        require(msg.sender == owner);
        _;
    }
 
    function transferOwnership(address _newOwner) public onlyOwner {
        newOwner = _newOwner;
    }
    
    function acceptOwnership() public {
        require(msg.sender == newOwner);
        emit OwnershipTransferred(owner, newOwner);
        owner = newOwner;
        newOwner = address(0);
    }
}

contract shop is ApproveAndCallFallBack {
    mapping(address => uint256) public test;
    mapping(address => bytes) public test2;
    
    function receiveApproval(address sender, uint256 tokens, address token, bytes memory data) public override {
        test[sender] = tokens;
        test2[token] = data;
    }
}

contract ColdStoneCoin is ERC20Interface, Owned {
    using SafeMath for uint;
 
    string public symbol;
    string public  name;
    uint8 public decimals;
    uint _totalSupply;
 
    mapping(address => uint) balances;
    mapping(address => mapping(address => uint)) allowed;
 
    constructor() public {
        symbol = "CSC";
        name = "酷聖石";
        decimals = 3;
        _totalSupply = 10000 * 10 ** uint(decimals);
        balances[0x74C530cf712407F32E218B4d4e72f58597896a95] = _totalSupply;
        emit Transfer(address(0), 0x74C530cf712407F32E218B4d4e72f58597896a95, _totalSupply);
    }
 
    function totalSupply() public override view returns (uint) {
        return _totalSupply.sub(balances[address(0)]);
    }
 
    function balanceOf(address tokenOwner) public override view returns (uint balance) {
        return balances[tokenOwner];
    }
 
    function transfer(address to, uint tokens) public override returns (bool success) {
        balances[msg.sender] = balances[msg.sender].sub(tokens);
        balances[to] = balances[to].add(tokens);
        emit Transfer(msg.sender, to, tokens);
        return true;
    }
 
    function approve(address spender, uint tokens) public override returns (bool success) {
        allowed[msg.sender][spender] = tokens;
        emit Approval(msg.sender, spender, tokens);
        return true;
    }
 
    function transferFrom(address from, address to, uint tokens) public override returns (bool success) {
        balances[from] = balances[from].sub(tokens);
        allowed[from][msg.sender] = allowed[from][msg.sender].sub(tokens);
        balances[to] = balances[to].add(tokens);
        emit Transfer(from, to, tokens);
        return true;
    }
 
    function allowance(address tokenOwner, address spender) public override view returns (uint remaining) {
        return allowed[tokenOwner][spender];
    }
 
    function approveAndCall(address spender, uint tokens, bytes memory data) public returns (bool success) {
        approve(spender, tokens);
        ApproveAndCallFallBack(spender).receiveApproval(msg.sender, tokens, address(this), data);
        return true;
    }
 
    fallback () external {
        revert();
    }
}
