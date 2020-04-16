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

interface ApproveAndCallFallBack {
    function receiveApproval(address sender, uint256 tokens, address tokenAdd, bytes calldata data) external;
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

contract ShopCoinDemo is ERC20Interface, Owned {
    using SafeMath for uint;
 
    string public symbol;
    string public  name;
    uint8 public decimals;
    uint _totalSupply;
 
    mapping(address => uint) balances;
    mapping(address => mapping(address => uint)) allowed;
 
    constructor() public {
        symbol = "SCD";
        name = "ShopCoinDemo";
        decimals = 3;  
        _totalSupply = 10000 * 10 ** uint(decimals);
        balances[msg.sender] = _totalSupply;
        emit Transfer(address(0), msg.sender, _totalSupply);
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
 
    function transferFrom(address _from, address to, uint tokens) public override returns (bool success) {
        balances[_from] = balances[_from].sub(tokens);
        allowed[_from][msg.sender] = allowed[_from][msg.sender].sub(tokens);
        balances[to] = balances[to].add(tokens);
        emit Transfer(_from, to, tokens);
        return true;
    }
 
    function allowance(address tokenOwner, address spender) public override view returns (uint remaining) {
        return allowed[tokenOwner][spender];
    }
 
    function approveAndCall(address spender, uint256 tokens, bytes memory data) public returns (bool success) {
        approve(spender, tokens);
        ApproveAndCallFallBack(spender).receiveApproval(msg.sender, tokens, address(this), data);
        return true;
    }
 
    fallback () external {
        revert();
    }
}

contract Shop {
    mapping(address => uint) public buyerList;
    uint256 price = 10;
    
    function receiveApproval(address sender, uint256 tokens, address tokenAdd, bytes memory data) public returns (address, uint256, address, bytes memory){
        require(msg.sender == tokenAdd, "Error token contract address");
        buy(sender, tokens, tokenAdd);
        return (sender, tokens, tokenAdd, data);
    }
    
    function buy(address buyer, uint256 tokens, address tokenAdd) private {
        require(tokens >= price, "Value is not enougth");
        uint256 amount = tokens / price;
        getTokenFrom(tx.origin, tokens, tokenAdd);
        buyerList[buyer] += amount;
    }
    
    function getTokenFrom(address tokenFrom, uint256 tokenAmount, address tokenAdd) private {
        ShopCoinDemo(tokenAdd).transferFrom(address(tokenFrom), address(this), tokenAmount);
    }
    
}
